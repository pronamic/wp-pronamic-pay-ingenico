<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Http\Facades\Http;
use Pronamic\WordPress\Pay\Core\Util;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Error;
use Pronamic\WordPress\Pay\Gateways\Ingenico\XML\OrderResponseParser;

/**
 * Title: Ingenico DirectLink client
 * Description:
 * Copyright: 2005-2022 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.4
 * @since   1.0.0
 */
class Client {
	/**
	 * API URL.
	 *
	 * @var string
	 */
	public $api_url;

	/**
	 * PSP ID.
	 *
	 * @var string
	 */
	public $psp_id;

	/**
	 * SHA IN.
	 *
	 * @var string
	 */
	public $sha_in;

	/**
	 * User ID.
	 *
	 * @var string
	 */
	public $user_id;

	/**
	 * Password.
	 *
	 * @var string
	 */
	public $password;

	/**
	 * Constructs and initializes an Ogone DirectLink client
	 */
	public function __construct() {
		$this->api_url = DirectLink::API_PRODUCTION_URL;
	}

	/**
	 * Order direct
	 *
	 * @param array $data Data.
	 *
	 * @return bool|OrderResponse
	 * @throws \Exception Throws exception if DirectLink request fails.
	 */
	public function order_direct( array $data = [] ) {
		$response = Http::request(
			$this->api_url,
			[
				'method'    => 'POST',
				'sslverify' => false,
				'body'      => $data,
			]
		);

		$xml = $response->simplexml();

		$order_response = OrderResponseParser::parse( $xml );

		if ( ! empty( $order_response->nc_error ) ) {
			$ogone_error = new Error(
				(string) $order_response->nc_error,
				(string) $order_response->nc_error_plus
			);

			throw new \Exception( (string) $ogone_error );
		}

		return $order_response;
	}
}
