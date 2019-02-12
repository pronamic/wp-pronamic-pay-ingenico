<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

class SecurityTest extends \WP_UnitTestCase {
	/**
	 * Test get calculations parameters in.
	 */
	public function test_get_calculations_parameters_in() {
		$parameters = Security::get_calculations_parameters_in();

		$this->assertContains( Parameters::AMOUNT, $parameters );
	}

	/**
	 * Test get calculations parameters out.
	 */
	public function test_get_calculations_parameters_out() {
		$parameters = Security::get_calculations_parameters_out();

		$this->assertContains( Parameters::NC_ERROR, $parameters );
	}
}
