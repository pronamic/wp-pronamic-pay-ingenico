<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

class ErrorTest extends \WP_UnitTestCase {
	/**
	 * Test error.
	 */
	public function test_error() {
		$error = new Error( 'code', 'explanation' );

		$string = (string) $error;

		$this->assertEquals( 'code explanation', $string );
	}
}
