<?php

/**
 * Title: Ogone order standard gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2011
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Gateway extends Pronamic_WP_Pay_Gateway {
	/**
	 * Slug of this gateway
	 *
	 * @var string
	 */
	const SLUG = 'ogone_orderstandard';

	/////////////////////////////////////////////////

	/**
	 * Constructs and initializes an InternetKassa gateway
	 *
	 * @param Pronamic_WordPress_IDeal_Configuration $config
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Config $config ) {
		parent::__construct( $config );

		$this->set_method( Pronamic_WP_Pay_Gateway::METHOD_HTML_FORM );
		$this->set_has_feedback( true );
		$this->set_amount_minimum( 0.01 );
		$this->set_slug( self::SLUG );

		$this->client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client( $this->config->psp_id );

		$this->client->set_payment_server_url( $config->url );
		$this->client->set_pass_phrase_in( $config->sha_in_pass_phrase );
		$this->client->set_pass_phrase_out( $config->sha_out_pass_phrase );

		if ( ! empty( $config->hash_algorithm ) ) {
			$this->client->set_hash_algorithm( $config->hash_algorithm );
		}
	}

	/////////////////////////////////////////////////

	/**
	 * Start
	 *
	 * @param Pronamic_Pay_PaymentDataInterface $data
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

		// URL's
		$ogone_url_helper = new Pronamic_WP_Pay_Gateways_Ogone_DataUrlHelper( $ogone_data );

		$url = add_query_arg( 'payment', $payment->get_id(), home_url( '/' ) );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', 'accept', $url ) )
			->set_cancel_url( add_query_arg( 'status', 'cancel', $url ) )
			->set_decline_url( add_query_arg( 'status', 'decline', $url ) )
			->set_exception_url( add_query_arg( 'status', 'exception', $url ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Get output HTML
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_output_html()
	 */
	public function get_output_html() {
		return $this->client->get_html_fields();
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Pronamic_Pay_Payment $payment
	 */
	public function update_status( Pronamic_Pay_Payment $payment ) {
		$data = Pronamic_WP_Pay_Gateways_Ogone_Security::get_request_data();

		$data = $this->client->verify_request( $data );

		if ( false !== $data ) {
			$status = Pronamic_WP_Pay_Gateways_Ogone_Statuses::transform( $data[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::STATUS ] );

			$payment->set_status( $status );

			$this->update_status_payment_note( $payment, $data );
		}
	}

	/////////////////////////////////////////////////

	/**
	 * Update status payment note
	 *
	 * @param Pronamic_Pay_Payment $payment
	 * @param array $data
	 */
	private function update_status_payment_note( Pronamic_Pay_Payment $payment, $data ) {
		$labels = array(
			'STATUS'               => __( 'Status', 'pronamic_ideal' ),
			'ORDERID'              => __( 'Order ID', 'pronamic_ideal' ),
			'CURRENCY'             => __( 'Currency', 'pronamic_ideal' ),
			'AMOUNT'               => __( 'Amount', 'pronamic_ideal' ),
			'PM'                   => __( 'Payment Method', 'pronamic_ideal' ),
			'ACCEPTANCE'           => __( 'Acceptance', 'pronamic_ideal' ),
			'STATUS'               => __( 'Status', 'pronamic_ideal' ),
			'CARDNO'               => __( 'Card Number', 'pronamic_ideal' ),
			'ED'                   => __( 'End Date', 'pronamic_ideal' ),
			'CN'                   => __( 'Customer Name', 'pronamic_ideal' ),
			'TRXDATE'              => __( 'Transaction Date', 'pronamic_ideal' ),
			'PAYID'                => __( 'Pay ID', 'pronamic_ideal' ),
			'NCERROR'              => __( 'NC Error', 'pronamic_ideal' ),
			'BRAND'                => __( 'Brand', 'pronamic_ideal' ),
			'IP'                   => __( 'IP', 'pronamic_ideal' ),
			'SHASIGN'              => __( 'SHA Signature', 'pronamic_ideal' ),
		);

		$note = '';

		$note .= '<p>';
		$note .= __( 'Ogone transaction data in response message:', 'pronamic_ideal' );
		$note .= '</p>';

		$note .= '<dl>';

		foreach ( $labels as $key => $label ) {
			if ( isset( $data[ $key ] ) && '' != $data[ $key ] ) {
				$note .= sprintf( '<dt>%s</dt>', esc_html( $label ) );
				$note .= sprintf( '<dd>%s</dd>', esc_html( $data[ $key ] ) );
			}
		}

		$note .= '</dl>';

		$payment->add_note( $note );
	}
}
