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
class Pronamic_WP_Pay_Gateways_Ogone_DataCreditCardHelperTest extends WP_UnitTestCase {
	/**
	 * Test helper
	 */
	function test_helper() {
		$data = new Pronamic_WP_Pay_Gateways_Ogone_Data();

		$helper = new Pronamic_WP_Pay_Gateways_Ogone_DataCreditCardHelper( $data );

		$ed = new DateTime();

		$helper
			->set_number( '378282246310005' )
			->set_expiration_date( $ed )
			->set_security_code( '123' );

		$this->assertEquals( array(
			'CARDNO' => '378282246310005',
			'ED'     => $ed->format( Pronamic_WP_Pay_Gateways_Ogone_Ogone::EXPIRATION_DATE_FORMAT ),
			'CVC'    => '123',
		), $data->get_fields() );
	}
}
