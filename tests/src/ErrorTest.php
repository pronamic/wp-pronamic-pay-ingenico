<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class ErrorTest extends TestCase {
	/**
	 * Test error.
	 */
	public function test_error() {
		$error = new Error( 'code', 'explanation' );

		$string = (string) $error;

		$this->assertEquals( 'code explanation', $string );
	}
}
