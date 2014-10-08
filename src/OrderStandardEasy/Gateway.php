<?php

/**
 * Title: Easy
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
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

		$this->client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Client();
		$this->client->set_payment_server_url( $config->url );
		$this->client->set_psp_id( $config->psp_id );
	}

	/////////////////////////////////////////////////

	/**
	 * Get output HTML
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_output_html()
	 * @return string
	 */
	public function get_output_html() {
		return $this->client->get_html_fields();
	}

	/////////////////////////////////////////////////

	/**
	 * Start transaction with the specified data
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 */
	public function start( Pronamic_Pay_PaymentDataInterface $data, Pronamic_Pay_Payment $payment ) {
		$payment->set_action_url( $this->client->get_payment_server_url() );

		$ogone_data = $this->client->get_data();

		// General
		$ogone_data_general = new Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_order_id( $data->get_order_id() )
			->set_order_description( $data->get_description() )
			->set_currency( $data->get_currency() )
			->set_amount( $data->get_amount() )
			->set_customer_name( $data->getCustomerName() )
			->set_language( $data->get_language_and_country() )
			->set_email( $data->get_email() );

		// Other
		$ogone_data
			->set_field( 'owneraddress', $data->getOwnerAddress() )
			->set_field( 'ownertown', $data->getOwnerCity() )
			->set_field( 'ownerzip', $data->getOwnerZip() );

		// URL's
		$ogone_url_helper = new Pronamic_WP_Pay_Gateways_Ogone_DataUrlHelper( $ogone_data );

		$url = add_query_arg( 'payment', $payment->get_id(), home_url( '/' ) );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', Pronamic_Gateways_IDealAdvancedV3_Status::SUCCESS, $url ) )
			->set_cancel_url( add_query_arg( 'status', Pronamic_Gateways_IDealAdvancedV3_Status::CANCELLED, $url ) )
			->set_decline_url( add_query_arg( 'status', Pronamic_Gateways_IDealAdvancedV3_Status::FAILURE, $url ) )
			->set_exception_url( add_query_arg( 'status', Pronamic_Gateways_IDealAdvancedV3_Status::FAILURE, $url ) )
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
