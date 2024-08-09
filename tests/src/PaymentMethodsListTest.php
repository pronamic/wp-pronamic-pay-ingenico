<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Title: Ogone payment methods list (PMLIST parameter) test
 * Description:
 * Copyright: 2005-2024 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class PaymentMethodsListTest extends TestCase {
	/**
	 * Test constructor.
	 */
	public function test_constructor() {
		$list = new PaymentMethodsList(
			[
				Brands::VISA,
				Brands::MASTERCARD,
				Brands::AMERICAN_EXPRESS,
			]
		);

		$string = (string) $list;

		$this->assertEquals( 'VISA;MasterCard;American Express', $string );
	}

	/**
	 * Test add payment method.
	 */
	public function test_add_payment_method() {
		$list = new PaymentMethodsList();
		$list->add_payment_method( Brands::VISA );
		$list->add_payment_method( Brands::MASTERCARD );
		$list->add_payment_method( Brands::AMERICAN_EXPRESS );

		$string = (string) $list;

		$this->assertEquals( 'VISA;MasterCard;American Express', $string );
	}
}
