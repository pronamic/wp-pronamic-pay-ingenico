<?php

/**
 * Title: Ogone order standard client
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.2.1
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client {
	/**
	 * The payment server URL
	 *
	 * @var string
	 */
	private $payment_server_url;

	//////////////////////////////////////////////////

	/**
	 * Direct Query URL.
	 *
	 * @since 1.3.2
	 * @var string
	 */
	private $direct_query_url;

	//////////////////////////////////////////////////

	/**
	 * The amount
	 *
	 * @var int
	 */
	private $amount;

	//////////////////////////////////////////////////

	/**
	 * Pass phrase IN
	 *
	 * @var string
	 */
	private $pass_phrase_in;

	/**
	 * Pass phrase OUT
	 *
	 * @var string
	 */
	private $pass_phrase_out;

	//////////////////////////////////////////////////

	/**
	 * API user ID.
	 *
	 * @var string
	 */
	private $user_id;

	/**
	 * API user password.
	 *
	 * @var string
	 */
	private $password;

	//////////////////////////////////////////////////

	/**
	 * Data
	 *
	 * @var Pronamic_WP_Pay_Gateways_Ogone_Data
	 */
	private $data;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a iDEAL kassa object
	 */
	public function __construct( $psp_id ) {
		$this->data = new Pronamic_WP_Pay_Gateways_Ogone_Data();
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::PSPID, $psp_id );

		$this->hash_algorithm = Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_1;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the payment server URL
	 *
	 * @return the payment server URL
	 */
	public function get_payment_server_url() {
		return $this->payment_server_url;
	}

	/**
	 * Set the payment server URL
	 *
	 * @param string $url an URL
	 */
	public function set_payment_server_url( $url ) {
		$this->payment_server_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the Direct Query URL.
	 *
	 * @return string
	 */
	public function get_direct_query_url() {
		return $this->direct_query_url;
	}

	/**
	 * Set the Direct Query URL.
	 *
	 * @param string $url
	 */
	public function set_direct_query_url( $url ) {
		$this->direct_query_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get hash algorithm
	 *
	 * @return string
	 */
	public function get_hash_algorithm() {
		return $this->hash_algorithm;
	}

	/**
	 * Set hash algorithm
	 *
	 * @param string $hashAlgorithm
	 */
	public function set_hash_algorithm( $hash_algorithm ) {
		$this->hash_algorithm = $hash_algorithm;
	}

	//////////////////////////////////////////////////

	/**
	 * Get password phrase IN
	 *
	 * @return string
	 */
	public function get_pass_phrase_in() {
		return $this->pass_phrase_in;
	}

	/**
	 * Set password phrase IN
	 *
	 * @param string $pass_phrase_in
	 */
	public function set_pass_phrase_in( $pass_phrase_in ) {
		$this->pass_phrase_in = $pass_phrase_in;
	}

	//////////////////////////////////////////////////

	/**
	 * Get password phrase OUT
	 *
	 * @return string
	 */
	public function get_pass_phrase_out() {
		return $this->pass_phrase_out;
	}

	/**
	 * Set password phrase OUT
	 *
	 * @param string $pass_phrase_out
	 */
	public function set_pass_phrase_out( $pass_phrase_out ) {
		$this->pass_phrase_out = $pass_phrase_out;
	}

	//////////////////////////////////////////////////

	/**
	 * Get API user ID.
	 *
	 * @return string
	 */
	public function get_user_id() {
		return $this->user_id;
	}

	/**
	 * Set API user ID.
	 *
	 * @param string $user_id
	 */
	public function set_user_id( $user_id ) {
		$this->user_id = $user_id;
	}

	//////////////////////////////////////////////////

	/**
	 * Get API user password.
	 *
	 * @return string
	 */
	public function get_password() {
		return $this->password;
	}

	/**
	 * Set API user password.
	 *
	 * @param string $pass_phrase_out
	 */
	public function set_password( $password ) {
		$this->password = $password;
	}

	//////////////////////////////////////////////////
	// Data
	//////////////////////////////////////////////////

	/**
	 * Get data
	 *
	 * @return Pronamic_WP_Pay_Gateways_Ogone_Data
	 */
	public function get_data() {
		return $this->data;
	}

	//////////////////////////////////////////////////
	// Signature functions
	//////////////////////////////////////////////////

	/**
	 * Get signature IN
	 *
	 * @return string
	 */
	public function get_signature_in() {
		$calculation_fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculations_parameters_in();

		$fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculation_fields( $calculation_fields, $this->data->get_fields() );

		return Pronamic_WP_Pay_Gateways_Ogone_Security::get_signature( $fields, $this->get_pass_phrase_in(), $this->hash_algorithm );
	}

	/**
	 * Get signature OUT
	 *
	 * @param array $fields
	 */
	public function get_signature_out( $fields ) {
		$calculation_fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculations_parameters_out();

		$fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculation_fields( $calculation_fields, $fields );

		return Pronamic_WP_Pay_Gateways_Ogone_Security::get_signature( $fields, $this->get_pass_phrase_out(), $this->hash_algorithm );
	}

	//////////////////////////////////////////////////

	/**
	 * Get fields
	 *
	 * @since 1.2.1
	 * @return array
	 */
	public function get_fields() {
		Pronamic_WP_Pay_Gateways_Ogone_Security::sign_data( $this->data, $this->get_pass_phrase_in(), $this->hash_algorithm );

		return $this->data->get_fields();
	}

	//////////////////////////////////////////////////

	/**
	 * Get order status
	 */
	public function get_order_status( $order_id ) {
		$return = null;

		// API user ID and password
		$user_id  = $this->get_user_id();
		$password = $this->get_password();

		if ( '' === $user_id || '' === $password ) {
			return $return;
		}

		$result = Pronamic_WP_Pay_Util::remote_get_body( $this->get_direct_query_url(), 200, array(
			'method'  => 'POST',
			'body'    => array(
				Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID  => $order_id,
				Pronamic_WP_Pay_Gateways_Ogone_Parameters::PSPID    => $this->data->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::PSPID ),
				Pronamic_WP_Pay_Gateways_Ogone_Parameters::USER_ID  => $user_id,
				Pronamic_WP_Pay_Gateways_Ogone_Parameters::PASSWORD => $password,
			),
			'timeout' => 30,
		) );

		$xml = Pronamic_WP_Pay_Util::simplexml_load_string( $result );

		if ( ! is_wp_error( $xml ) ) {
			$order_response = Pronamic_WP_Pay_Gateways_Ogone_OrderResponseParser::parse( $xml );

			$status = Pronamic_WP_Pay_XML_Security::filter( $order_response->status );

			$return = Pronamic_WP_Pay_Gateways_Ogone_Statuses::transform( $status );
		}

		return $return;
	}

	//////////////////////////////////////////////////

	/**
	 * Verify request
	 */
	public function verify_request( $data ) {
		$result = false;

		$data = array_change_key_case( $data, CASE_UPPER );

		if ( isset( $data['SHASIGN'] ) ) {
			$signature = $data['SHASIGN'];

			$signature_out = $this->get_signature_out( $data );

			if ( 0 === strcasecmp( $signature, $signature_out ) ) {
				$result = filter_var_array( $data, array(
					Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID  => FILTER_SANITIZE_STRING,
					Pronamic_WP_Pay_Gateways_Ogone_Parameters::AMOUNT   => FILTER_VALIDATE_FLOAT,
					Pronamic_WP_Pay_Gateways_Ogone_Parameters::CURRENCY => FILTER_SANITIZE_STRING,
					'PM'         => FILTER_SANITIZE_STRING,
					'ACCEPTANCE' => FILTER_SANITIZE_STRING,
					'STATUS'     => FILTER_VALIDATE_INT,
					'CARDNO'     => FILTER_SANITIZE_STRING,
					'PAYID'      => FILTER_VALIDATE_INT,
					'NCERROR'    => FILTER_SANITIZE_STRING,
					'BRAND'      => FILTER_SANITIZE_STRING,
					'SHASIGN'    => FILTER_SANITIZE_STRING,
				) );
			}
		}

		return $result;
	}
}
