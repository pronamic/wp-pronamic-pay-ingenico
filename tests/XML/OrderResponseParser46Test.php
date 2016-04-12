<?php

class Pronamic_WP_Pay_Gateways_Ogone_OrderResponseParser46Test extends WP_UnitTestCase {
	/**
	 * Test initialize.
	 *
	 * @return SimpleXMLElement
	 */
	function test_init() {
		$filename = dirname( __FILE__ ) . '/../Mock/response-status-46.xml';

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
		$filename = dirname( __FILE__ ) . '/../Mock/response-status-46-html-answer.html';

		$expected = new Pronamic_WP_Pay_Gateways_Ogone_DirectLink_OrderResponse();
		$expected->order_id      = '1387195001';
		$expected->pay_id        = '26187584';
		$expected->nc_error      = '0';
		$expected->status        = '46';
		$expected->nc_error_plus = 'Identification requested';
		$expected->html_answer   = file_get_contents( $filename );

		$this->assertEquals( $expected, $order_response );
	}
}
