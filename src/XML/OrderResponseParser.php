<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\XML;

use Pronamic\WordPress\Pay\Core\XML\Security;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink\OrderResponse;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;
use SimpleXMLElement;

/**
 * Title: Ingenico DirectLink order response XML parser
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 */
class OrderResponseParser {
	/**
	 * Parse the specified XML element into an iDEAL transaction object
	 *
	 * @param SimpleXMLElement $xml
	 * @param OrderResponse    $order_response
	 *
	 * @return null|OrderResponse
	 */
	public static function parse( SimpleXMLElement $xml, $order_response = null ) {
		if ( ! $order_response instanceof OrderResponse ) {
			$order_response = new OrderResponse();
		}

		$order_response->order_id      = Security::filter( $xml['orderID'] );
		$order_response->pay_id        = Security::filter( $xml['PAYID'] );
		$order_response->nc_status     = Security::filter( $xml[ Parameters::NC_STATUS ] );
		$order_response->nc_error      = Security::filter( $xml[ Parameters::NC_ERROR ] );
		$order_response->nc_error_plus = Security::filter( $xml[ Parameters::NC_ERROR_PLUS ] );
		$order_response->acceptance    = Security::filter( $xml['ACCEPTANCE'] );
		$order_response->status        = Security::filter( $xml[ Parameters::STATUS ] );
		$order_response->eci           = Security::filter( $xml['ECI'] );
		$order_response->amount        = Security::filter( $xml[ Parameters::AMOUNT ] );
		$order_response->currency      = Security::filter( $xml[ Parameters::CURRENCY ] );
		$order_response->pm            = Security::filter( $xml['PM'] );
		$order_response->brand         = Security::filter( $xml['BRAND'] );

		if ( $xml->HTML_ANSWER ) {
			// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
			$order_response->html_answer = base64_decode( Security::filter( $xml->HTML_ANSWER ) );
		}

		return $order_response;
	}
}
