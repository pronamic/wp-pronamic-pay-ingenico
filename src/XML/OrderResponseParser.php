<?php

/**
 * Title: Ogone DirectLink order response XML parser
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderResponseParser {
	/**
	 * Parse the specified XML element into an iDEAL transaction object
	 *
	 * @param SimpleXMLElement $xml
	 * @param Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse $order_response
	 */
	public static function parse( SimpleXMLElement $xml, $order_response = null ) {
		if ( ! $order_response instanceof Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse ) {
			$order_response = new Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse();
		}

		$order_response->order_id      = Pronamic_WP_Pay_XML_Security::filter( $xml['orderID'] );
		$order_response->pay_id        = Pronamic_WP_Pay_XML_Security::filter( $xml['PAYID'] );
		$order_response->nc_status     = Pronamic_WP_Pay_XML_Security::filter( $xml[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::NC_STATUS ] );
		$order_response->nc_error      = Pronamic_WP_Pay_XML_Security::filter( $xml[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::NC_ERROR ] );
		$order_response->nc_error_plus = Pronamic_WP_Pay_XML_Security::filter( $xml[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::NC_ERROR_PLUS ] );
		$order_response->acceptance    = Pronamic_WP_Pay_XML_Security::filter( $xml['ACCEPTANCE'] );
		$order_response->status        = Pronamic_WP_Pay_XML_Security::filter( $xml[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::STATUS ] );
		$order_response->eci           = Pronamic_WP_Pay_XML_Security::filter( $xml['ECI'] );
		$order_response->amount        = Pronamic_WP_Pay_XML_Security::filter( $xml[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::AMOUNT ] );
		$order_response->currency      = Pronamic_WP_Pay_XML_Security::filter( $xml[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::CURRENCY ] );
		$order_response->pm            = Pronamic_WP_Pay_XML_Security::filter( $xml['PM'] );
		$order_response->brand         = Pronamic_WP_Pay_XML_Security::filter( $xml['BRAND'] );

		if ( $xml->HTML_ANSWER ) {
			$order_response->html_answer = base64_decode( Pronamic_WP_Pay_XML_Security::filter( $xml->HTML_ANSWER ) );
		}

		return $order_response;
	}
}
