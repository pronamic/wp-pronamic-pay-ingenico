<?php

class Pronamic_WP_Pay_Gateways_Ogone_ErrorTest extends WP_UnitTestCase {
	function test_error() {
		$error = new Pronamic_WP_Pay_Gateways_Ogone_Error( 'code', 'explanation' );

		$string = (string) $error;

		$this->assertEquals( 'code explanation', $string );
	}
}
