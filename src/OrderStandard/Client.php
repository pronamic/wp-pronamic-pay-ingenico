<?php

/**
 * Title: Ogone order standard client
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
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
	 * Get HTML fields
	 *
	 * @return string
	 */
	public function get_html_fields() {
		Pronamic_WP_Pay_Gateways_Ogone_Security::sign_data( $this->data, $this->get_pass_phrase_in(), $this->hash_algorithm );

		return Pronamic_IDeal_IDeal::htmlHiddenFields( $this->data->get_fields() );
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
