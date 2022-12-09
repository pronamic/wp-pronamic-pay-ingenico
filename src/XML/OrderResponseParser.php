<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\XML;

use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink\OrderResponse;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;
use SimpleXMLElement;

/**
 * Title: Ingenico DirectLink order response XML parser
 * Description:
 * Copyright: 2005-2022 Pronamic
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

		$order_response->order_id      = (string) $xml['orderID'];
		$order_response->pay_id        = (string) $xml['PAYID'];
		$order_response->nc_status     = (string) $xml[ Parameters::NC_STATUS ];
		$order_response->nc_error      = (string) $xml[ Parameters::NC_ERROR ];
		$order_response->nc_error_plus = (string) $xml[ Parameters::NC_ERROR_PLUS ];
		$order_response->acceptance    = (string) $xml['ACCEPTANCE'];
		$order_response->status        = (string) $xml[ Parameters::STATUS ];
		$order_response->eci           = (string) $xml['ECI'];
		$order_response->amount        = (string) $xml[ Parameters::AMOUNT ];
		$order_response->currency      = (string) $xml[ Parameters::CURRENCY ];
		$order_response->pm            = (string) $xml['PM'];
		$order_response->brand         = (string) $xml['BRAND'];

		if ( $xml->HTML_ANSWER ) {
			// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
			$order_response->html_answer = base64_decode( (string) $xml->HTML_ANSWER );
		}

		return $order_response;
	}
}
