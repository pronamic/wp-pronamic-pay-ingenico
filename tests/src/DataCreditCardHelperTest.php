<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use DateTime;

/**
 * Title: Ogone data default helper class test
 * Description:
 * Copyright: 2005-2020 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class DataCreditCardHelperTest extends \WP_UnitTestCase {
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
			array(
				'CARDNO' => '378282246310005',
				'ED'     => $ed->format( Ingenico::EXPIRATION_DATE_FORMAT ),
				'CVC'    => '123',
			),
			$data->get_fields()
		);
	}
}
