<?php

/**
 * Title: Ogone order standard gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.2
 * @since 1.0.0
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

		$this->supports = array(
			'payment_status_request',
		);

		$this->set_method( Pronamic_WP_Pay_Gateway::METHOD_HTML_FORM );
		$this->set_has_feedback( true );
		$this->set_amount_minimum( 0.01 );
		$this->set_slug( self::SLUG );

		$this->client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client( $this->config->psp_id );

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

	/////////////////////////////////////////////////

	/**
	 * Get payment methods
	 *
	 * @since unreleased
	 * @return mixed an array or null
	 */
	public function get_payment_methods() {
		$methods_class = 'Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods';

		if ( class_exists( $methods_class ) ) {
			$payment_methods = new ReflectionClass( $methods_class );

			$groups = array(
				array(
					'options' => $payment_methods->getConstants(),
				),
			);

			return $groups;
		}

		return null;
	}

	/**
	 * Get supported payment methods
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_supported_payment_methods()
	 */
	public function get_supported_payment_methods() {
		return array(
			Pronamic_WP_Pay_PaymentMethods::IDEAL,
			Pronamic_WP_Pay_PaymentMethods::CREDIT_CARD,
			Pronamic_WP_Pay_PaymentMethods::BANCONTACT,
		);
	}

	/////////////////////////////////////////////////

	/**
	 * Start
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

		// Payment method
		// @see https://github.com/wp-pay-gateways/ogone/wiki/Brands
		switch ( $payment->get_method() ) {
			case Pronamic_WP_Pay_PaymentMethods::CREDIT_CARD :
				/*
				 * Set credit card payment method.
				 * @since 1.2.3
				 */
				$ogone_data_general
					->set_payment_method( Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods::CREDIT_CARD );

				break;
			case Pronamic_WP_Pay_PaymentMethods::IDEAL :
				/*
				 * Set iDEAL payment method.
				 * @since 1.2.3
				 */
				$ogone_data_general
					->set_brand( Pronamic_WP_Pay_Gateways_Ogone_Brands::IDEAL )
					->set_payment_method( Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods::IDEAL );

				break;
			case Pronamic_WP_Pay_PaymentMethods::BANCONTACT :
			case Pronamic_WP_Pay_PaymentMethods::MISTER_CASH :
				$ogone_data_general
					->set_brand( Pronamic_WP_Pay_Gateways_Ogone_Brands::BCMC )
					->set_payment_method( Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods::CREDIT_CARD );

				break;
		}

		// Parameter Variable
		$param_var = Pronamic_WP_Pay_Gateways_Ogone_Util::get_param_var( $this->config->param_var );

		if ( ! empty( $param_var ) ) {
			$ogone_data->set_field( 'PARAMVAR', $param_var );
		}

		// Template Page
		$template_page = $this->config->param_var;

		if ( ! empty( $template_page ) ) {
			$ogone_data->set_field( 'TP', $template_page );
		}

		// URL's
		$ogone_url_helper = new Pronamic_WP_Pay_Gateways_Ogone_DataUrlHelper( $ogone_data );

		$ogone_url_helper
			->set_accept_url( add_query_arg( 'status', 'accept', $payment->get_return_url() ) )
			->set_cancel_url( add_query_arg( 'status', 'cancel', $payment->get_return_url() ) )
			->set_decline_url( add_query_arg( 'status', 'decline', $payment->get_return_url() ) )
			->set_exception_url( add_query_arg( 'status', 'exception', $payment->get_return_url() ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Get output fields
	 *
	 * @since 1.2.1
	 * @see Pronamic_WP_Pay_Gateway::get_output_html()
	 */
	public function get_output_fields() {
		return $this->client->get_fields();
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

			return;
		}

		$order_id = $payment->format_string( $this->config->order_id );

		$status = $this->client->get_order_status( $order_id );

		if ( null !== $status ) {
			$payment->set_status( $status );
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
			if ( isset( $data[ $key ] ) && '' !== $data[ $key ] ) {
				$note .= sprintf( '<dt>%s</dt>', esc_html( $label ) );
				$note .= sprintf( '<dd>%s</dd>', esc_html( $data[ $key ] ) );
			}
		}

		$note .= '</dl>';

		$payment->add_note( $note );
	}
}
