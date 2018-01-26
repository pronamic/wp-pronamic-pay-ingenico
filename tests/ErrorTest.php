<?php

use Pronamic\WordPress\Pay\Gateways\Ingenico\Error;

class Pronamic_WP_Pay_Gateways_Ogone_ErrorTest extends WP_UnitTestCase {
	function test_error() {
		$error = new Error( 'code', 'explanation' );

		$string = (string) $error;

		$this->assertEquals( 'code explanation', $string );
	}
}
