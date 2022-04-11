<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\PaymentMethods as Core_PaymentMethods;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Brands;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataCustomerHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataGeneralHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataUrlHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;
use Pronamic\WordPress\Pay\Gateways\Ingenico\PaymentMethods;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Statuses;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Util;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Security;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: Ingenico order standard gateway
 * Description:
 * Copyright: 2005-2022 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.4
 * @since   1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Config
	 *
	 * @var Config
	 */
	protected $config;

	/**
	 * Client.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Constructs and initializes an OrderStandard gateway
	 *
	 * @param Config $config Config.
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->config = $config;

		$this->set_method( self::METHOD_HTML_FORM );

		// Supported features.
		$this->supports = array(
			'payment_status_request',
		);

		// Client.
		$this->client = new Client( $config->psp_id );

		$this->client->set_payment_server_url( $config->get_form_action_url() );
		$this->client->set_direct_query_url( $config->get_direct_query_url() );
		$this->client->set_pass_phrase_in( $config->sha_in_pass_phrase );
		$this->client->set_pass_phrase_out( $config->sha_out_pass_phrase );
		$this->client->set_user_id( $config->user_id );
		$this->client->set_password( $config->password );

		if ( ! empty( $config->hash_algorithm ) ) {
			$this->client->set_hash_algorithm( $config->hash_algorithm );
		}
	}
	/**
	 * Get supported payment methods
	 *
	 * @see Core_Gateway::get_supported_payment_methods()
	 */
	public function get_supported_payment_methods() {
		return array(
			Core_PaymentMethods::BANK_TRANSFER,
			Core_PaymentMethods::IDEAL,
			Core_PaymentMethods::CREDIT_CARD,
			Core_PaymentMethods::BANCONTACT,
			Core_PaymentMethods::PAYPAL,
		);
	}

	/**
	 * Start
	 *
	 * @see Core_Gateway::start()
	 *
	 * @param Payment $payment Payment.
	 */
	public function start( Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		if ( $this->config->alias_enabled ) {
			$alias = uniqid();

			$payment->set_meta( 'ogone_alias', $alias );
		}
	}

	/**
	 * Get output fields
	 *
	 * @param Payment $payment Payment.
	 *
	 * @return array
	 * @since   1.2.1
	 * @version 2.0.4
	 * @see     Core_Gateway::get_output_html()
	 */
	public function get_output_fields( Payment $payment ) {
		$ogone_data = $this->client->get_data();

		// General.
		$ogone_data_general = new DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_order_id( $payment->format_string( $this->config->order_id ) )
			->set_order_description( $payment->get_description() )
			->set_param_plus( 'payment_id=' . $payment->get_id() )
			->set_currency( $payment->get_total_amount()->get_currency()->get_alphabetic_code() )
			->set_amount( $payment->get_total_amount()->get_minor_units()->format( 0, '', '' ) );

		// Alias.
		$alias = $payment->get_meta( 'ogone_alias' );

		if ( $this->config->alias_enabled && false !== $alias ) {
			$ogone_data_general->set_alias( $alias )
								->set_alias_usage( $this->config->alias_usage );
		}

		$customer = $payment->get_customer();

		// Language.
		$locale = \get_locale();

		if ( null !== $customer ) {
			$customer_locale = $customer->get_locale();

			// Locale not always contains `_`, e.g. "Nederlands" in Firefox.
			if ( null !== $customer_locale && false !== \strpos( $customer_locale, '_' ) ) {
				$locale = $customer_locale;
			}
		}

		$ogone_data_general->set_language( $locale );

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

		/*
		 * Payment method.
		 *
		 * @link https://github.com/wp-pay-gateways/ogone/wiki/Brands
		 */
		switch ( $payment->get_payment_method() ) {
			case Core_PaymentMethods::BANK_TRANSFER:
				/*
				 * Set bank transfer payment method.
				 * @since 2.2.0
				 */
				$ogone_data_general
					->set_payment_method( PaymentMethods::BANK_TRANSFER );

				break;
			case Core_PaymentMethods::CREDIT_CARD:
				/*
				 * Set credit card payment method.
				 * @since 1.2.3
				 */
				$ogone_data_general
					->set_payment_method( PaymentMethods::CREDIT_CARD );

				break;
			case Core_PaymentMethods::IDEAL:
				/*
				 * Set iDEAL payment method.
				 * @since 1.2.3
				 */
				$ogone_data_general
					->set_brand( Brands::IDEAL )
					->set_payment_method( PaymentMethods::IDEAL );

				break;
			case Core_PaymentMethods::BANCONTACT:
			case Core_PaymentMethods::MISTER_CASH:
				$ogone_data_general
					->set_brand( Brands::BCMC )
					->set_payment_method( PaymentMethods::CREDIT_CARD );

				break;
			case Core_PaymentMethods::PAYPAL:
				$ogone_data_general
					->set_payment_method( PaymentMethods::PAYPAL );

				break;
		}

		// Parameter Variable.
		$param_var = Util::get_param_var( $this->config->param_var );

		if ( ! empty( $param_var ) ) {
			$ogone_data->set_field( 'PARAMVAR', $param_var );
		}

		// Template Page.
		$template_page = $this->config->template_page;

		if ( ! empty( $template_page ) ) {
			$ogone_data->set_field( 'TP', $template_page );
		}

		// URLs.
		$ogone_url_helper = new DataUrlHelper( $ogone_data );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', 'accept', $payment->get_return_url() ) )
			->set_cancel_url( add_query_arg( 'status', 'cancel', $payment->get_return_url() ) )
			->set_decline_url( add_query_arg( 'status', 'decline', $payment->get_return_url() ) )
			->set_exception_url( add_query_arg( 'status', 'exception', $payment->get_return_url() ) );

		return $this->client->get_fields();
	}

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment Payment.
	 */
	public function update_status( Payment $payment ) {
		$data = Security::get_request_data();

		$data = $this->client->verify_request( $data );

		if ( false !== $data ) {
			$status = Statuses::transform( $data[ Parameters::STATUS ] );

			$payment->set_status( $status );

			// Update transaction ID.
			if ( \array_key_exists( Parameters::PAY_ID, $data ) ) {
				$payment->set_transaction_id( $data[ Parameters::PAY_ID ] );
			}

			// Add payment note.
			$this->update_status_payment_note( $payment, $data );

			return;
		}

		// Get order status with direct query.
		$order_id = $payment->format_string( $this->config->order_id );

		try {
			$status = $this->client->get_order_status( $order_id );
		} catch ( \Exception $e ) {
			$payment->add_note( $e->getMessage() );

			return;
		}

		if ( null !== $status ) {
			$payment->set_status( $status );
		}
	}

	/**
	 * Update status payment note
	 *
	 * @param Payment $payment Payment.
	 * @param array   $data    Data.
	 */
	private function update_status_payment_note( Payment $payment, $data ) {
		$labels = array(
			'STATUS'     => __( 'Status', 'pronamic_ideal' ),
			'ORDERID'    => __( 'Order ID', 'pronamic_ideal' ),
			'CURRENCY'   => __( 'Currency', 'pronamic_ideal' ),
			'AMOUNT'     => __( 'Amount', 'pronamic_ideal' ),
			'PM'         => __( 'Payment Method', 'pronamic_ideal' ),
			'ACCEPTANCE' => __( 'Acceptance', 'pronamic_ideal' ),
			'CARDNO'     => __( 'Card Number', 'pronamic_ideal' ),
			'ED'         => __( 'End Date', 'pronamic_ideal' ),
			'CN'         => __( 'Customer Name', 'pronamic_ideal' ),
			'TRXDATE'    => __( 'Transaction Date', 'pronamic_ideal' ),
			'PAYID'      => __( 'Pay ID', 'pronamic_ideal' ),
			'NCERROR'    => __( 'NC Error', 'pronamic_ideal' ),
			'BRAND'      => __( 'Brand', 'pronamic_ideal' ),
			'IP'         => __( 'IP', 'pronamic_ideal' ),
			'SHASIGN'    => __( 'SHA Signature', 'pronamic_ideal' ),
		);

		$note = '';

		$note .= '<p>';
		$note .= __( 'Ogone transaction data in response message:', 'pronamic_ideal' );
		$note .= '</p>';

		$note .= '<dl>';

		foreach ( $labels as $key => $label ) {
			if ( isset( $data[ $key ] ) && '' !== $data[ $key ] ) {
				$note .= sprintf( '<dt>%s</dt>', esc_html( $label ) );
				$note .= sprintf( '<dd>%s</dd>', esc_html( $data[ $key ] ) );
			}
		}

		$note .= '</dl>';

		$payment->add_note( $note );
	}
}
