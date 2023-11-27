<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use DateTime;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Title: Ogone data default helper class test
 * Description:
 * Copyright: 2005-2023 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class DataCreditCardHelperTest extends TestCase {
	/**
	 * Test helper.
	 */
	public function test_helper() {
		$data = new Data();

		$helper = new DataCreditCardHelper( $data );

		$ed = new DateTime();

		$helper
			->set_number( '378282246310005' )
			->set_expiration_date( $ed )
			->set_security_code( '123' );

		$this->assertEquals(
			[
				'CARDNO' => '378282246310005',
				'ED'     => $ed->format( Ingenico::EXPIRATION_DATE_FORMAT ),
				'CVC'    => '123',
			],
			$data->get_fields()
		);
	}
}
