<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\Server;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Data;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataCreditCardHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataCustomerHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataGeneralHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;
use Pronamic\WordPress\Pay\Gateways\Ingenico\SecureDataHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Statuses;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Security;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: Ingenico DirectLink gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.2
 * @since   1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Client.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Constructs and initializes an Ogone DirectLink gateway
	 *
	 * @param Config $config Config.
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->set_method( self::METHOD_HTTP_REDIRECT );

		$this->client           = new Client();
		$this->client->psp_id   = $config->psp_id;
		$this->client->sha_in   = $config->sha_in_pass_phrase;
		$this->client->user_id  = $config->user_id;
		$this->client->password = $config->password;
		$this->client->api_url  = $config->api_url;
	}

	/**
	 * Start
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 *
	 * @param Payment $payment Payment.
	 */
	public function start( Payment $payment ) {
		$ogone_data = new Data();

		// General.
		$ogone_data_general = new DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_psp_id( $this->client->psp_id )
			->set_order_id( $payment->format_string( $this->config->order_id ) )
			->set_order_description( $payment->get_description() )
			->set_param_plus( 'payment_id=' . $payment->get_id() )
			->set_currency( $payment->get_total_amount()->get_currency()->get_alphabetic_code() )
			->set_amount( $payment->get_total_amount()->get_cents() );

		// Alias.
		if ( $this->config->alias_enabled ) {
			$alias = uniqid();

			$payment->set_meta( 'ogone_alias', $alias );

			$ogone_data_general->set_alias( $alias );
		}

		$customer = $payment->get_customer();

		if ( null !== $customer ) {
			// Localised language.
			$ogone_data_general->set_language( $customer->get_locale() );
		}

		// Customer.
		$ogone_data_customer = new DataCustomerHelper( $ogone_data );

		if ( null !== $customer ) {
			$name = $customer->get_name();

			if ( null !== $name ) {
				$ogone_data_customer->set_name( strval( $name ) );
			}

			$ogone_data_customer->set_email( $customer->get_email() );
		}

		$billing_address = $payment->get_billing_address();

		if ( null !== $billing_address ) {
			$ogone_data_customer
				->set_address( $billing_address->get_line_1() )
				->set_zip( $billing_address->get_postal_code() )
				->set_town( $billing_address->get_city() )
				->set_country( $billing_address->get_country_code() )
				->set_telephone_number( $billing_address->get_phone() );
		}

		// DirectLink.
		$ogone_data_directlink = new DataHelper( $ogone_data );

		$ogone_data_directlink
			->set_user_id( $this->client->user_id )
			->set_password( $this->client->password );

		// Credit card.
		$ogone_data_credit_card = new DataCreditCardHelper( $ogone_data );

		$credit_card = $payment->get_credit_card();

		if ( $credit_card ) {
			$ogone_data_credit_card
				->set_number( $credit_card->get_number() )
				->set_expiration_date( $credit_card->get_expiration_date() )
				->set_security_code( $credit_card->get_security_code() );
		}

		$ogone_data->set_field( 'OPERATION', 'SAL' );

		// 3-D Secure
		if ( $this->config->enabled_3d_secure ) {
			$secure_data_helper = new SecureDataHelper( $ogone_data );

			$secure_data_helper
				->set_3d_secure_flag( true )
				->set_http_accept( Server::get( 'HTTP_ACCEPT' ) )
				->set_http_user_agent( Server::get( 'HTTP_USER_AGENT' ) )
				->set_window( 'MAINW' );

			$ogone_data->set_field( 'ACCEPTURL', $payment->get_return_url() );
			$ogone_data->set_field( 'DECLINEURL', $payment->get_return_url() );
			$ogone_data->set_field( 'EXCEPTIONURL', $payment->get_return_url() );
			$ogone_data->set_field( 'COMPLUS', '' );
		}

		// Signature.
		$calculation_fields = Security::get_calculations_parameters_in();

		$fields = Security::get_calculation_fields( $calculation_fields, $ogone_data->get_fields() );

		$signature = Security::get_signature( $fields, $this->config->sha_in_pass_phrase, $this->config->hash_algorithm );

		$ogone_data->set_field( 'SHASIGN', $signature );

		// Order.
		$result = $this->client->order_direct( $ogone_data->get_fields() );

		$error = $this->client->get_error();

		if ( is_wp_error( $error ) ) {
			$this->error = $error;
		} else {
			$payment->set_transaction_id( $result->pay_id );
			$payment->set_action_url( $payment->get_return_url() );
			$payment->set_status( Statuses::transform( $result->status ) );

			if ( ! empty( $result->html_answer ) ) {
				$payment->set_meta( 'ogone_directlink_html_answer', $result->html_answer );
				$payment->set_action_url( $payment->get_pay_redirect_url() );
			}
		}
	}

	/**
	 * Payment redirect.
	 *
	 * @param Payment $payment Payment.
	 *
	 * @return void
	 */
	public function payment_redirect( Payment $payment ) {
		$html_answer = $payment->get_meta( 'ogone_directlink_html_answer' );

		if ( ! empty( $html_answer ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $html_answer;

			exit;
		}
	}

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment Payment.
	 */
	public function update_status( Payment $payment ) {
		$data = Security::get_request_data();

		$data = array_change_key_case( $data, CASE_UPPER );

		$calculation_fields = Security::get_calculations_parameters_out();

		$fields = Security::get_calculation_fields( $calculation_fields, $data );

		$signature     = $data['SHASIGN'];
		$signature_out = Security::get_signature( $fields, $this->config->sha_out_pass_phrase, $this->config->hash_algorithm );

		if ( 0 === strcasecmp( $signature, $signature_out ) ) {
			$status = Statuses::transform( $data[ Parameters::STATUS ] );

			$payment->set_status( $status );
		}
	}
}
