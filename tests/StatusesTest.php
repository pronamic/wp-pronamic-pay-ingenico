<?php

/**
 * Title: Ogone statuses constants tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_StatusesTest extends PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider statusMatrixProvider
	 */
	public function testTransform( $mollieStatus, $expected ) {
		$status = Pronamic_WP_Pay_Gateways_Ogone_Statuses::transform( $mollieStatus );

		$this->assertEquals( $expected, $status );
	}

	public function statusMatrixProvider() {
		return array(
			// Failture
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::INCOMPLETE_OR_INVALID, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::INCOMPLETE_OR_INVALID, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHORIZATION_REFUSED, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHOR_DELETION_REFUSED, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_DELETION_REFUSED, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::REFUND_REFUSED, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_DECLIEND_BY_THE_ACQUIRER, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_REFUSED, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::REFUND_DECLINED_BY_THE_ACQUIRER, Pronamic_WP_Pay_Statuses::FAILURE ),
			// Cancelled
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::CANCELLED_BY_CLIENT, Pronamic_WP_Pay_Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHORIZED_AND_CANCELLED, Pronamic_WP_Pay_Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHORIZED_AND_CANCELLED_64, Pronamic_WP_Pay_Statuses::CANCELLED ),
			// Open
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::ORDER_STORED, Pronamic_WP_Pay_Statuses::OPEN ),
		);
    }
}
