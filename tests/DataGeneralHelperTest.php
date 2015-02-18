<?php

/**
 * Title: Ogone data default helper class test
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.1.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelperTest extends WP_UnitTestCase {
	/**
	 * Test helper
	 */
	function test_helper() {
		$data = new Pronamic_WP_Pay_Gateways_Ogone_Data();

		$helper = new Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper( $data );

		$helper
			->set_psp_id( 'test' )
			->set_order_id( '1234' );

		$this->assertEquals( 'test', $data->get_field( 'PSPID' ) );
		$this->assertEquals( '1234', $data->get_field( 'ORDERID' ) );
	}
}
