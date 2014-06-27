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
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::STORED_WAITING_EXTERNAL_RESULT, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::WAITING_CLIENT_PAYMENT, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUHTORIZED_WAITING_EXTERNAL_RESULT, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHORIZATION_WAITING, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHORIZATION_NOT_KNOWN, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::STAND_BY, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::OK_WITH_SCHEDULED_PAYMENTS, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::ERROR_IN_SCHEDULED_PAYMENTS, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUHORIZ_TO_GET_MANUALLY, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHOR_DELETION_WAITING, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHOR_DELETION_UNCERTAIN, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_DELETION_PENDING, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_DELETION_UNCERTAIN, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_DELETED_74, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::DELETION_PROCESSED_BY_MERCHANT, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::REFUND_PENDING, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::REFUND_UNCERTAIN, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_UNCERTAIN, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_PROCESSING, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::BEING_PROCESSED, Pronamic_WP_Pay_Statuses::OPEN ),
			// Success
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::AUTHORIZED, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_DELETED, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::REFUND, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::REFUND_PROCESSED_BY_MERCHANT, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_REQUESTED, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_Ogone_Statuses::PAYMENT_PROCESSED_BY_MERCHANT, Pronamic_WP_Pay_Statuses::SUCCESS ),
		);
    }
}
