<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico security class
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 */
class Security {
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

	/**
	 * Get request data
	 *
	 * @return array
	 */
	public static function get_request_data() {
		$data = array();

		if ( isset( $_SERVER['REQUEST_METHOD'] ) ) { // WPCS: input var ok.
			switch ( $_SERVER['REQUEST_METHOD'] ) { // WPCS: input var ok.
				case 'GET':
					// @todo see how we can improve security around this
					// phpcs:ignore WordPress.Security.NonceVerification.Recommended
					$data = $_GET;

					break;
				case 'POST':
					// @todo see how we can improve security around this
					// phpcs:ignore WordPress.Security.NonceVerification.Missing
					$data = $_POST;

					break;
			}
		}

		return $data;
	}

	/**
	 * Get calculation fields.
	 *
	 * @param array $calculation_fields Calculation fields.
	 * @param array $fields             Fields.
	 *
	 * @return array
	 */
	public static function get_calculation_fields( $calculation_fields, $fields ) {
		$calculation_fields = array_flip( $calculation_fields );

		return array_intersect_key( $fields, $calculation_fields );
	}

	/**
	 * Get signature.
	 *
	 * @param array  $fields         Fields.
	 * @param string $passphrase     Pass phrase.
	 * @param string $hash_algorithm Hashing algorithm.
	 *
	 * @return string
	 */
	public static function get_signature( $fields, $passphrase, $hash_algorithm ) {
		// This string is constructed by concatenating the values of the fields sent with the order (sorted
		// alphabetically, in the format ‘parameter=value’), separated by a passphrase.
		$string = '';

		// All parameters need to be put alphabetically.
		ksort( $fields );

		// Loop.
		foreach ( $fields as $name => $value ) {
			$value = (string) $value;

			// Use of empty will fail, value can be string '0'.
			if ( strlen( $value ) > 0 ) {
				$name = strtoupper( $name );

				$string .= $name . '=' . $value . $passphrase;
			}
		}

		// Hash.
		$result = hash( $hash_algorithm, $string );

		// String to uppercase.
		$result = strtoupper( $result );

		return $result;
	}

	/**
	 * Sign data.
	 *
	 * @param Data   $data           Data.
	 * @param string $pass_phrase    Pass phrase.
	 * @param string $hash_algorithm Hashing algorithm.
	 */
	public static function sign_data( Data $data, $pass_phrase, $hash_algorithm ) {
		$calculation_fields = self::get_calculations_parameters_in();

		$fields = self::get_calculation_fields( $calculation_fields, $data->get_fields() );

		$signature = self::get_signature( $fields, $pass_phrase, $hash_algorithm );

		$data->set_field( 'SHASign', $signature );
	}
}
