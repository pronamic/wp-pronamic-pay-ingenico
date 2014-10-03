<?php

/**
 * Title: Ogone DirectLink
 * Description:
 * Copyright: Copyright (c) 2005 - 2013
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.4.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Client {
	/**
	 * Error
	 *
	 * @var WP_Error
	 */
	private $error;

	/////////////////////////////////////////////////

	/**
	 * API URL
	 *
	 * @var string
	 */
	public $api_url;

	/////////////////////////////////////////////////

	/**
	 * Constructs and initializes an Ogone DirectLink client
	 */
	public function __construct() {
		$this->api_url = Pronamic_Pay_Gateways_Ogone_DirectLink::API_PRODUCTION_URL;
	}

	/////////////////////////////////////////////////

	/**
	 * Get error
	 *
	 * @return WP_Error
	 */
	public function get_error() {
		return $this->error;
	}

	/////////////////////////////////////////////////

	/**
	 * Order direct
	 *
	 * @param array $data
	 */
	public function order_direct( array $data = array() ) {
		$order_response = false;

		$result = Pronamic_WP_Util::remote_get_body( $this->api_url, 200, array(
			'method'    => 'POST',
			'sslverify' => false,
			'body'      => $data,
		) );

		if ( is_wp_error( $result ) ) {
			$this->error = $result;
		} else {
			$xml = Pronamic_WP_Util::simplexml_load_string( $result );

			if ( is_wp_error( $xml ) ) {
				$this->error = $xml;
			} else {
				$order_response = Pronamic_Gateways_Ogone_XML_OrderResponseParser::parse( $xml );

				if ( ! empty( $order_response->nc_error ) ) {
					$ogone_error = new Pronamic_Pay_Gateways_Ogone_Error();
					$ogone_error->code        = Pronamic_XML_Util::filter( $order_response->nc_error );
					$ogone_error->explanation = Pronamic_XML_Util::filter( $order_response->nc_error_plus );

					$this->error = new WP_Error( 'ogone_error', (string) $ogone_error, $ogone_error );
				}
			}
		}

		return $order_response;
	}
}
