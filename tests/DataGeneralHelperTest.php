<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ogone data default helper class test
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 */
class DataGeneralHelperTest extends \WP_UnitTestCase {
	/**
	 * Test helper
	 */
	function test_helper() {
		$data = new Data();

		$helper = new DataGeneralHelper( $data );

		$pmlist = new PaymentMethodsList( array(
			Brands::VISA,
			Brands::MASTERCARD,
			Brands::AMERICAN_EXPRESS,
		) );

		$helper
			->set_psp_id( 'test' )
			->set_order_id( '1234' )
			->set_order_description( 'order description' )
			->set_amount( 10.50 )
			->set_currency( 'EUR' )
			->set_customer_name( 'Mr. Test' )
			->set_email( 'test@example.com' )
			->set_language( 'nl' )
			->set_payment_method( PaymentMethods::IDEAL )
			->set_payment_methods_list( $pmlist )
			->set_brand( Brands::IDEAL );

		$this->assertEquals( array(
			'PSPID'    => 'test',
			'ORDERID'  => '1234',
			'COM'      => 'order description',
			'AMOUNT'   => 1050,
			'CURRENCY' => 'EUR',
			'CN'       => 'Mr. Test',
			'EMAIL'    => 'test@example.com',
			'LANGUAGE' => 'nl',
			'PM'       => PaymentMethods::IDEAL,
			'PMLIST'   => (string) $pmlist,
			'BRAND'    => Brands::IDEAL,
		), $data->get_fields() );
	}
}
