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
 * @author Remco Tolsma
 * @version 1.3.2
 * @since 1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Construct and intialize an iDEAL Easy gateway
	 *
	 * @param Config $config
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->set_method( Gateway::METHOD_HTML_FORM );
		$this->set_has_feedback( false );
		$this->set_amount_minimum( 0.01 );

		$this->client = new Client( $config->psp_id );
		$this->client->set_payment_server_url( $config->get_form_action_url() );
	}

	/////////////////////////////////////////////////

	/**
	 * Get payment methods
	 *
	 * @see Core_Gateway::get_payment_methods()
	 */
	public function get_payment_methods() {
		return PaymentMethods::IDEAL;
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

	/////////////////////////////////////////////////

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

	/////////////////////////////////////////////////

	/**
	 * Start transaction with the specified data
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 */
	public function start( Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		$ogone_data = $this->client->get_data();

		// General
		$ogone_data_general = new DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_order_id( $payment->format_string( $this->config->order_id ) )
			->set_order_description( $payment->get_description() )
			->set_param_plus( 'payment_id=' . $payment->get_id() )
			->set_currency( $payment->get_currency() )
			->set_amount( $payment->get_amount() )
			->set_language( $payment->get_locale() );

		// Customer
		$ogone_data_customer = new DataCustomerHelper( $ogone_data );

		$ogone_data_customer
			->set_name( $payment->get_customer_name() )
			->set_email( $payment->get_email() )
			->set_address( $payment->get_address() )
			->set_zip( $payment->get_zip() )
			->set_town( $payment->get_city() )
			->set_country( $payment->get_country() )
			->set_telephone_number( $payment->get_telephone_number() );

		// URL's
		$ogone_url_helper = new DataUrlHelper( $ogone_data );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', Statuses::SUCCESS, $payment->get_return_url() ) )
			->set_cancel_url( add_query_arg( 'status', Statuses::CANCELLED, $payment->get_return_url() ) )
			->set_decline_url( add_query_arg( 'status', Statuses::FAILURE, $payment->get_return_url() ) )
			->set_exception_url( add_query_arg( 'status', Statuses::FAILURE, $payment->get_return_url() ) )
			->set_back_url( home_url( '/' ) )
			->set_home_url( home_url( '/' ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment
	 */
	public function update_status( Payment $payment ) {
		if ( ! filter_has_var( INPUT_GET, 'status' ) ) {
			return;
		}

		$status = filter_input( INPUT_GET, 'status', FILTER_SANITIZE_STRING );

		$payment->set_status( $status );
	}
}
