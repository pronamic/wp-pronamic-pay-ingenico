<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

use Pronamic\WordPress\Http\Facades\Http;
use Pronamic\WordPress\Pay\Core\Util;
use Pronamic\WordPress\Pay\Core\XML\Security as XML_Security;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Data;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Error;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Ingenico;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Statuses;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Security;

/**
 * Title: Ingenico order standard client
 * Description:
 * Copyright: 2005-2023 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.1.1
 * @since   1.0.0
 */
class Client {
	/**
	 * The payment server URL
	 *
	 * @var string
	 */
	private $payment_server_url;

	/**
	 * Direct Query URL.
	 *
	 * @since 1.3.2
	 * @var string
	 */
	private $direct_query_url;

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

	/**
	 * Data
	 *
	 * @var Data
	 */
	private $data;

	/**
	 * Hashing algorithm.
	 *
	 * @var string
	 */
	private $hash_algorithm;

	/**
	 * Constructs and initialize a iDEAL kassa object
	 *
	 * @param string $psp_id PSP ID.
	 */
	public function __construct( $psp_id ) {
		$this->data = new Data();
		$this->data->set_field( Parameters::PSPID, $psp_id );

		$this->hash_algorithm = Ingenico::SHA_1;
	}

	/**
	 * Get the payment server URL
	 *
	 * @return string Payment server URL.
	 */
	public function get_payment_server_url() {
		return $this->payment_server_url;
	}

	/**
	 * Set the payment server URL
	 *
	 * @param string $url Payment server URL.
	 * @return void
	 */
	public function set_payment_server_url( $url ) {
		$this->payment_server_url = $url;
	}

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
	 * @param string $url Direct query URL.
	 * @return void
	 */
	public function set_direct_query_url( $url ) {
		$this->direct_query_url = $url;
	}

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
	 * @param string $hash_algorithm Hashing algorithm.
	 * @return void
	 */
	public function set_hash_algorithm( $hash_algorithm ) {
		$this->hash_algorithm = $hash_algorithm;
	}

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
	 * @param string $pass_phrase_in Pass phrase IN.
	 * @return void
	 */
	public function set_pass_phrase_in( $pass_phrase_in ) {
		$this->pass_phrase_in = $pass_phrase_in;
	}

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
	 * @param string $pass_phrase_out Pass phrase OUT.
	 * @return void
	 */
	public function set_pass_phrase_out( $pass_phrase_out ) {
		$this->pass_phrase_out = $pass_phrase_out;
	}

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
	 * @param string $user_id API user ID.
	 * @return void
	 */
	public function set_user_id( $user_id ) {
		$this->user_id = $user_id;
	}

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
	 * @param string $password API user password.
	 * @return void
	 */
	public function set_password( $password ) {
		$this->password = $password;
	}

	/**
	 * Get data
	 *
	 * @return Data
	 */
	public function get_data() {
		return $this->data;
	}

	/**
	 * Get signature IN
	 *
	 * @return string
	 */
	public function get_signature_in() {
		$calculation_fields = Security::get_calculations_parameters_in();

		$fields = Security::get_calculation_fields( $calculation_fields, $this->data->get_fields() );

		return Security::get_signature( $fields, $this->get_pass_phrase_in(), $this->hash_algorithm );
	}

	/**
	 * Get signature OUT
	 *
	 * @param array $fields Fields to calculate signature for.
	 * @return string
	 */
	public function get_signature_out( $fields ) {
		$calculation_fields = Security::get_calculations_parameters_out();

		$fields = Security::get_calculation_fields( $calculation_fields, $fields );

		return Security::get_signature( $fields, $this->get_pass_phrase_out(), $this->hash_algorithm );
	}

	/**
	 * Get fields
	 *
	 * @since 1.2.1
	 * @return array
	 */
	public function get_fields() {
		Security::sign_data( $this->data, $this->get_pass_phrase_in(), $this->hash_algorithm );

		return $this->data->get_fields();
	}

	/**
	 * Get order status
	 *
	 * @param string $order_id Order ID.
	 * @return string|null
	 * @throws \Exception Throw exception on error in retrieving order status.
	 */
	public function get_order_status( $order_id ) {
		$return = null;

		// API user ID and password.
		$user_id  = $this->get_user_id();
		$password = $this->get_password();

		if ( '' === $user_id || '' === $password ) {
			return $return;
		}

		$response = Http::request(
			$this->get_direct_query_url(),
			[
				'method'  => 'POST',
				'body'    => [
					Parameters::ORDERID  => $order_id,
					Parameters::PSPID    => $this->data->get_field( Parameters::PSPID ),
					Parameters::USER_ID  => $user_id,
					Parameters::PASSWORD => $password,
				],
				'timeout' => 30,
			]
		);

		$xml = $response->simplexml();

		$nc_error = (string) $xml[ Parameters::NC_ERROR ];

		if ( '0' !== $nc_error ) {
			$ogone_error = new Error(
				$nc_error,
				(string) $xml[ Parameters::NC_ERROR_PLUS ]
			);

			throw new \Exception(
				\sprintf(
					'Could not get order status for order ID %s, error: %s.',
					\esc_html( $order_id ),
					\esc_html( (string) $ogone_error )
				)
			);
		}

		$status = (string) $xml[ Parameters::STATUS ];

		$return = Statuses::transform( $status );

		return $return;
	}

	/**
	 * Verify request
	 *
	 * @param array $data Request data.
	 * @return array|false
	 */
	public function verify_request( $data ) {
		$result = false;

		$data = array_change_key_case( $data, CASE_UPPER );

		if ( isset( $data['SHASIGN'] ) ) {
			$signature = $data['SHASIGN'];

			$signature_out = $this->get_signature_out( $data );

			if ( 0 === strcasecmp( $signature, $signature_out ) ) {
				$result = filter_var_array(
					$data,
					[
						Parameters::AMOUNT => FILTER_VALIDATE_FLOAT,
						'STATUS'           => FILTER_VALIDATE_INT,
						'PAYID'            => FILTER_VALIDATE_INT,
					]
				);

				$sanitize_params = [
					Parameters::ORDERID,
					Parameters::CURRENCY,
					'PM',
					'ACCEPTANCE',
					'CARDNO',
					'NCERROR',
					'BRAND',
					'SHASIGN',
				];

				foreach ( $sanitize_params as $param ) {
					if ( ! \array_key_exists( $param, $data ) ) {
						continue;
					}

					$result[ $param ] = \sanitize_text_field( \wp_unslash( $data[ $param ] ) );
				}
			}
		}

		return $result;
	}
}
