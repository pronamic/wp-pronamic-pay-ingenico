<?php

use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Security;

class Pronamic_WP_Pay_Gateways_Ogone_SecurityTest extends WP_UnitTestCase {
	function test_get_calculations_parameters_in() {
		$parameters = Security::get_calculations_parameters_in();

		$this->assertContains( Parameters::AMOUNT, $parameters );
	}

	function test_get_calculations_parameters_out() {
		$parameters = Security::get_calculations_parameters_out();

		$this->assertContains( Parameters::NC_ERROR, $parameters );
	}
}
