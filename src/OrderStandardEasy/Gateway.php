<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandardEasy;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\PaymentMethods;
use Pronamic\WordPress\Pay\Core\Statuses;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataCustomerHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataGeneralHelper;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataUrlHelper;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: Easy
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
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
	 * Construct and intialize an iDEAL Easy gateway
	 *
	 * @param Config $config Config.
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->set_method( self::METHOD_HTML_FORM );

		$this->client = new Client( $config->psp_id );
		$this->client->set_payment_server_url( $config->get_form_action_url() );
	}

	/**
	 * Get supported payment methods
	 *
	 * @see Core_Gateway::get_supported_payment_methods()
	 */
	public function get_supported_payment_methods() {
		return array(
			PaymentMethods::IDEAL,
		);
	}

	/**
	 * Get output fields
	 *
	 * @since 1.2.1
	 * @see Core_Gateway::get_output_html()
	 * @return array
	 */
	public function get_output_fields() {
		return $this->client->get_fields();
	}

	/**
	 * Start transaction with the specified data
	 *
	 * @see Core_Gateway::start()
	 *
	 * @param Payment $payment Payment.
	 */
	public function start( Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		$ogone_data = $this->client->get_data();

		// General.
		$ogone_data_general = new DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_order_id( $payment->format_string( $this->config->order_id ) )
			->set_order_description( $payment->get_description() )
			->set_param_plus( 'payment_id=' . $payment->get_id() )
			->set_currency( $payment->get_total_amount()->get_currency()->get_alphabetic_code() )
			->set_amount( $payment->get_total_amount()->get_cents() );

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

		// URLs.
		$ogone_url_helper = new DataUrlHelper( $ogone_data );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', Statuses::SUCCESS, $payment->get_return_url() ) )
			->set_cancel_url( add_query_arg( 'status', Statuses::CANCELLED, $payment->get_return_url() ) )
			->set_decline_url( add_query_arg( 'status', Statuses::FAILURE, $payment->get_return_url() ) )
			->set_exception_url( add_query_arg( 'status', Statuses::FAILURE, $payment->get_return_url() ) )
			->set_back_url( home_url( '/' ) )
			->set_home_url( home_url( '/' ) );
	}

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment Payment.
	 */
	public function update_status( Payment $payment ) {
		if ( ! filter_has_var( INPUT_GET, 'status' ) ) {
			return;
		}

		$status = filter_input( INPUT_GET, 'status', FILTER_SANITIZE_STRING );

		$payment->set_status( $status );
	}
}
