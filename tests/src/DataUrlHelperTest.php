<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Title: Ogone data URL helper class test
 * Description:
 * Copyright: 2005-2023 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class DataUrlHelperTest extends TestCase {
	/**
	 * Test URL helper.
	 */
	public function test_helper() {
		$data = new Data();

		$helper = new DataUrlHelper( $data );

		$helper
			->set_accept_url( 'http://www.example.com/payment/accepted/' )
			->set_cancel_url( 'http://www.example.com/payment/cancelled/' )
			->set_exception_url( 'http://www.example.com/payment/exception/' )
			->set_decline_url( 'http://www.example.com/payment/declined/' )
			->set_home_url( 'http://www.example.com/' )
			->set_back_url( 'http://www.example.com/payment/' );

		$this->assertEquals(
			[
				'ACCEPTURL'    => 'http://www.example.com/payment/accepted/',
				'CANCELURL'    => 'http://www.example.com/payment/cancelled/',
				'EXCEPTIONURL' => 'http://www.example.com/payment/exception/',
				'DECLINEURL'   => 'http://www.example.com/payment/declined/',
				'home'         => 'http://www.example.com/',
				'backurl'      => 'http://www.example.com/payment/',
			],
			$data->get_fields()
		);
	}
}
