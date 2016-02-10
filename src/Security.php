<?php

/**
 * Title: Ogone security class
* Description:
* Copyright: Copyright (c) 2005 - 2016
* Company: Pronamic
 *
* @author Remco Tolsma
* @version 1.0.0
*/
class Pronamic_WP_Pay_Gateways_Ogone_Security {
	/**
	 * The Ogone calculations parameters in
	 *
	 * @var array
	 */
	private static $calculations_parameters_in;

	/**
	 * The Ogone calucations parameters out
	 *
	 * @var array
	 */
	private static $calculations_parameters_out;

	/////////////////////////////////////////////////

	/**
	 * Get calculations parameters in
	 */
	public static function get_calculations_parameters_in() {
		if ( ! isset( self::$calculations_parameters_in ) ) {
			self::$calculations_parameters_in = array();

			$file = dirname( __FILE__ ) . '/../data/calculations-parameters-sha-in.txt';
			if ( is_readable( $file ) ) {
				self::$calculations_parameters_in = file( $file, FILE_IGNORE_NEW_LINES );
			}
		}

		return self::$calculations_parameters_in;
	}

	/////////////////////////////////////////////////

	/**
	 * Get calculations parameters in
	 */
	public static function get_calculations_parameters_out() {
		if ( ! isset( self::$calculations_parameters_out ) ) {
			self::$calculations_parameters_out = array();

			$file = dirname( __FILE__ ) . '/../data/calculations-parameters-sha-out.txt';
			if ( is_readable( $file ) ) {
				self::$calculations_parameters_out = file( $file, FILE_IGNORE_NEW_LINES );
			}
		}

		return self::$calculations_parameters_out;
	}

	/////////////////////////////////////////////////

	/**
	 * Get request data
	 *
	 * @return array
	 */
	public static function get_request_data() {
		$data = array();

		if ( isset( $_SERVER['REQUEST_METHOD'] ) ) { // WPCS: input var okay
			switch ( $_SERVER['REQUEST_METHOD'] ) { // WPCS: input var okay
				case 'GET':
					// @todo see how we can improve security around this
					$data = $_GET; // WPCS: input var okay

					break;
				case 'POST':
					// @todo see how we can improve security around this
					$data = $_POST; // WPCS: input var okay // WPCS: CSRF OK

					break;
			}
		}

		return $data;
	}

	/////////////////////////////////////////////////

	public static function get_calculation_fields( $calculation_fields, $fields ) {
		$calculation_fields = array_flip( $calculation_fields );

		return array_intersect_key( $fields, $calculation_fields );
	}

	public static function get_signature( $fields, $passphrase, $hash_algorithm ) {
		// This string is constructed by concatenating the values of the fields sent with the order (sorted
		// alphabetically, in the format ‘parameter=value’), separated by a passphrase.
		$string = '';

		// All parameters need to be put alphabetically
		ksort( $fields );

		// Loop
		foreach ( $fields as $name => $value ) {
			$value = (string) $value;

			// Use of empty will fail, value can be string '0'
			if ( strlen( $value ) > 0 ) {
				$name = strtoupper( $name );

				$string .= $name . '=' . $value . $passphrase;
			}
		}

		// Hash
		$result = hash( $hash_algorithm, $string );

		// String to uppercase
		$result = strtoupper( $result );

		return $result;
	}

	/////////////////////////////////////////////////

	public static function sign_data( Pronamic_WP_Pay_Gateways_Ogone_Data $data, $pass_phrase, $hash_algorithm ) {
		$calculation_fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculations_parameters_in();

		$fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculation_fields( $calculation_fields, $data->get_fields() );

		$signature = Pronamic_WP_Pay_Gateways_Ogone_Security::get_signature( $fields, $pass_phrase, $hash_algorithm );

		$data->set_field( 'SHASign', $signature );
	}
}
