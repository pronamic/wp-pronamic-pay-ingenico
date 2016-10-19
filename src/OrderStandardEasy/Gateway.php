<?php

/**
 * Title: Easy
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.2
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Gateway extends Pronamic_WP_Pay_Gateway {
	/**
	 * Construct and intialize an iDEAL Easy gateway
	 *
	 * @param Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config $config
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config $config ) {
		parent::__construct( $config );

		$this->set_method( Pronamic_WP_Pay_Gateway::METHOD_HTML_FORM );
		$this->set_has_feedback( false );
		$this->set_amount_minimum( 0.01 );

		$this->client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Client( $config->psp_id );
		$this->client->set_payment_server_url( $config->get_form_action_url() );
	}

	/////////////////////////////////////////////////

	/**
	 * Get output fields
	 *
	 * @since 1.2.1
	 * @see Pronamic_WP_Pay_Gateway::get_output_html()
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
	public function start( Pronamic_Pay_Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		$ogone_data = $this->client->get_data();

		// General
		$ogone_data_general = new Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_order_id( $payment->format_string( $this->config->order_id ) )
			->set_order_description( $payment->get_description() )
			->set_param_plus( 'payment_id=' . $payment->get_id() )
			->set_currency( $payment->get_currency() )
			->set_amount( $payment->get_amount() )
			->set_language( $payment->get_locale() );

		// Customer
		$ogone_data_customer = new Pronamic_WP_Pay_Gateways_Ogone_DataCustomerHelper( $ogone_data );

		$ogone_data_customer
			->set_name( $payment->get_customer_name() )
			->set_email( $payment->get_email() )
			->set_address( $payment->get_address() )
			->set_zip( $payment->get_zip() )
			->set_town( $payment->get_city() )
			->set_country( $payment->get_country() )
			->set_telephone_number( $payment->get_telephone_number() );

		// URL's
		$ogone_url_helper = new Pronamic_WP_Pay_Gateways_Ogone_DataUrlHelper( $ogone_data );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', Pronamic_WP_Pay_Statuses::SUCCESS, $payment->get_return_url() ) )
			->set_cancel_url( add_query_arg( 'status', Pronamic_WP_Pay_Statuses::CANCELLED, $payment->get_return_url() ) )
			->set_decline_url( add_query_arg( 'status', Pronamic_WP_Pay_Statuses::FAILURE, $payment->get_return_url() ) )
			->set_exception_url( add_query_arg( 'status', Pronamic_WP_Pay_Statuses::FAILURE, $payment->get_return_url() ) )
			->set_back_url( home_url( '/' ) )
			->set_home_url( home_url( '/' ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Pronamic_Pay_Payment $payment
	 */
	public function update_status( Pronamic_Pay_Payment $payment ) {
		if ( filter_has_var( INPUT_GET, 'status' ) ) {
			$status = filter_input( INPUT_GET, 'status', FILTER_SANITIZE_STRING );

			$payment->set_status( $status );
		}
	}
}
