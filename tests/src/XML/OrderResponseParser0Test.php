<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\XML;

use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink\OrderResponse;

class OrderResponseParser0Test extends \WP_UnitTestCase {
	/**
	 * Test initialize.
	 *
	 * @return SimpleXMLElement
	 */
	public function test_init() {
		$filename = dirname( __FILE__ ) . '/../../Mock/response-status-0-50001123.xml';

		$simplexml = simplexml_load_file( $filename );

		$this->assertInstanceOf( 'SimpleXMLElement', $simplexml );

		return $simplexml;
	}

	/**
	 * Test parser.
	 *
	 * @depends test_init
	 *
	 * @param SimpleXMLElement $simplexml
	 *
	 * @return OrderResponse
	 */
	public function test_parser( $simplexml ) {
		$order_response = OrderResponseParser::parse( $simplexml );

		$this->assertInstanceOf( 'Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink\OrderResponse', $order_response );

		return $order_response;
	}

	/**
	 * Test values.
	 *
	 * @depends test_parser
	 *
	 * @param OrderResponse $order_response
	 */
	public function test_values( $order_response ) {
		$expected                = new OrderResponse();
		$expected->order_id      = '52';
		$expected->pay_id        = '0';
		$expected->nc_error      = '50001123';
		$expected->status        = '0';
		$expected->nc_error_plus = 'Card type not active for the merchant';

		$this->assertEquals( $expected, $order_response );
	}
}
