<?php

/**
 * Title: Ogone data default helper class test
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelperTest extends WP_UnitTestCase {
	/**
	 * Test helper
	 */
	function test_helper() {
		$data = new Pronamic_WP_Pay_Gateways_Ogone_Data();

		$helper = new Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper( $data );

		$pmlist = new Pronamic_WP_Pay_Gateways_Ogone_PaymentMethodsList( array(
			Pronamic_WP_Pay_Gateways_Ogone_Brands::VISA,
			Pronamic_WP_Pay_Gateways_Ogone_Brands::MASTERCARD,
			Pronamic_WP_Pay_Gateways_Ogone_Brands::AMERICAN_EXPRESS,
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
			->set_payment_method( Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods::IDEAL )
			->set_payment_methods_list( $pmlist )
			->set_brand( Pronamic_WP_Pay_Gateways_Ogone_Brands::IDEAL );

		$this->assertEquals( array(
			'PSPID'    => 'test',
			'ORDERID'  => '1234',
			'COM'      => 'order description',
			'AMOUNT'   => 1050,
			'CURRENCY' => 'EUR',
			'CN'       => 'Mr. Test',
			'EMAIL'    => 'test@example.com',
			'LANGUAGE' => 'nl',
			'PM'       => Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods::IDEAL,
			'PMLIST'   => (string) $pmlist,
			'BRAND'    => Pronamic_WP_Pay_Gateways_Ogone_Brands::IDEAL,
		), $data->get_fields() );
	}
}
