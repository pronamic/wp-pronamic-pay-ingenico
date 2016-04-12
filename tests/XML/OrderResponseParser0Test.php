<?php

class Pronamic_WP_Pay_Gateways_Ogone_OrderResponseParser0Test extends WP_UnitTestCase {
	/**
	 * Test initialize.
	 *
	 * @return SimpleXMLElement
	 */
	function test_init() {
		$filename = dirname( __FILE__ ) . '/../Mock/response-status-0-50001123.xml';

		$simplexml = simplexml_load_file( $filename );

		$this->assertInstanceOf( 'SimpleXMLElement', $simplexml );

		return $simplexml;
	}

	/**
	 * Test parser.
	 *
	 * @depends test_init
	 * @param SimpleXMLElement $simplexml
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse
	 */
	function test_parser( $simplexml ) {
		$order_response = Pronamic_WP_Pay_Gateways_Ogone_OrderResponseParser::parse( $simplexml );

		$this->assertInstanceOf( 'Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse', $order_response );

		return $order_response;
	}

	/**
	 * Test values.
	 *
	 * @depends test_parser
	 * @param Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse $order_response
	 */
	function test_values( $order_response ) {
		$expected = new Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse();
		$expected->order_id      = '52';
		$expected->pay_id        = '0';
		$expected->nc_error      = '50001123';
		$expected->status        = '0';
		$expected->nc_error_plus = 'Card type not active for the merchant';

		$this->assertEquals( $expected, $order_response );
	}
}
