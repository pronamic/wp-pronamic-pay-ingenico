<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Title: Ogone data default helper class test
 * Description:
 * Copyright: 2005-2024 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class DataGeneralHelperTest extends TestCase {
	/**
	 * Test helper
	 */
	public function test_helper() {
		$data = new Data();

		$helper = new DataGeneralHelper( $data );

		$pmlist = new PaymentMethodsList(
			[
				Brands::VISA,
				Brands::MASTERCARD,
				Brands::AMERICAN_EXPRESS,
			]
		);

		$helper
			->set_psp_id( 'test' )
			->set_order_id( '1234' )
			->set_order_description( 'order description' )
			->set_amount( '1050' )
			->set_currency( 'EUR' )
			->set_customer_name( 'Mr. Test' )
			->set_email( 'test@example.com' )
			->set_language( 'nl' )
			->set_payment_method( PaymentMethods::IDEAL )
			->set_payment_methods_list( $pmlist )
			->set_brand( Brands::IDEAL );

		$this->assertEquals(
			[
				'PSPID'    => 'test',
				'ORDERID'  => '1234',
				'COM'      => 'order description',
				'AMOUNT'   => '1050',
				'CURRENCY' => 'EUR',
				'CN'       => 'Mr. Test',
				'EMAIL'    => 'test@example.com',
				'LANGUAGE' => 'nl',
				'PM'       => PaymentMethods::IDEAL,
				'PMLIST'   => (string) $pmlist,
				'BRAND'    => Brands::IDEAL,
			],
			$data->get_fields()
		);
	}
}
