<?php

/**
 * Title: Ogone payment methods list (PMLIST parameter) test
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_PaymentMethodsListTest extends WP_UnitTestCase {
	/**
	 * Test constructor
	 */
	function test_constructor() {
		$list = new Pronamic_WP_Pay_Gateways_Ogone_PaymentMethodsList( array(
			Pronamic_WP_Pay_Gateways_Ogone_Brands::VISA,
			Pronamic_WP_Pay_Gateways_Ogone_Brands::MASTERCARD,
			Pronamic_WP_Pay_Gateways_Ogone_Brands::AMERICAN_EXPRESS,
		) );

		$string = (string) $list;

		$this->assertEquals( 'VISA;MasterCard;American Express', $string );
	}

	/**
	 * Test add payment method
	 */
	function test_add_payment_method() {
		$list = new Pronamic_WP_Pay_Gateways_Ogone_PaymentMethodsList();
		$list->add_payment_method( Pronamic_WP_Pay_Gateways_Ogone_Brands::VISA );
		$list->add_payment_method( Pronamic_WP_Pay_Gateways_Ogone_Brands::MASTERCARD );
		$list->add_payment_method( Pronamic_WP_Pay_Gateways_Ogone_Brands::AMERICAN_EXPRESS );

		$string = (string) $list;

		$this->assertEquals( 'VISA;MasterCard;American Express', $string );
	}
}
