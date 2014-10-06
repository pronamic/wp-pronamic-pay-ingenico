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
	 * Get output HTML
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_output_html()
	 */
	public function get_output_html() {
		return $this->client->getHtmlFields();
	}

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

		$this->client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client();

		$this->client->setPaymentServerUrl( $config->url );
		$this->client->setPspId( $config->psp_id );
		$this->client->setPassPhraseIn( $config->sha_in_pass_phrase );
		$this->client->setPassPhraseOut( $config->sha_out_pass_phrase );

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
		$payment->set_action_url( $this->client->getPaymentServerUrl() );

		$this->client->setLanguage( $data->get_language_and_country() );
		$this->client->setCurrency( $data->get_currency() );
		$this->client->setOrderId( $payment->get_id() );
		$this->client->setOrderDescription( $data->get_description() );
		$this->client->setAmount( $data->get_amount() );

		$this->client->setCustomerName( $data->getCustomerName() );
		$this->client->setEMailAddress( $data->get_email() );

		$url = add_query_arg( 'payment', $payment->get_id(), home_url( '/' ) );

		$this->client->setAcceptUrl( add_query_arg( 'status', 'accept', $url ) );
		$this->client->setCancelUrl( add_query_arg( 'status', 'cancel', $url ) );
		$this->client->setDeclineUrl( add_query_arg( 'status', 'decline', $url ) );
		$this->client->setExceptionUrl( add_query_arg( 'status', 'exception', $url ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Pronamic_Pay_Payment $payment
	 */
	public function update_status( Pronamic_Pay_Payment $payment ) {
		$inputs = array(
			INPUT_GET  => $_GET,
			INPUT_POST => $_POST,
		);

		foreach ( $inputs as $input => $data ) {
			$data = $this->client->verifyRequest( $data );

			if ( $data !== false ) {
				$status = Pronamic_WP_Pay_Gateways_Ogone_Statuses::transform( $data[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::STATUS ] );

				$payment->set_status( $status );

				$this->update_status_payment_note( $payment, $data );
			}
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