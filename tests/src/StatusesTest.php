<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Payments\PaymentStatus as Core_Statuses;

/**
 * Title: Ogone statuses constants tests
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 */
class StatusesTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test transform.
	 *
	 * @dataProvider status_matrix_provider
	 */
	public function test_transform( $ogone_status, $expected ) {
		$status = Statuses::transform( $ogone_status );

		$this->assertEquals( $expected, $status );
	}

	/**
	 * Stats matrix provider.
	 *
	 * @return array
	 */
	public function status_matrix_provider() {
		return array(
			// Failture
			array( Statuses::INCOMPLETE_OR_INVALID, Core_Statuses::FAILURE ),
			array( Statuses::AUTHORIZATION_REFUSED, Core_Statuses::FAILURE ),
			array( Statuses::AUTHOR_DELETION_REFUSED, Core_Statuses::FAILURE ),
			array( Statuses::PAYMENT_DELETION_REFUSED, Core_Statuses::FAILURE ),
			array( Statuses::REFUND_REFUSED, Core_Statuses::FAILURE ),
			array( Statuses::PAYMENT_DECLIEND_BY_THE_ACQUIRER, Core_Statuses::FAILURE ),
			array( Statuses::PAYMENT_REFUSED, Core_Statuses::FAILURE ),
			array( Statuses::REFUND_DECLINED_BY_THE_ACQUIRER, Core_Statuses::FAILURE ),
			// Cancelled
			array( Statuses::CANCELLED_BY_CLIENT, Core_Statuses::CANCELLED ),
			array( Statuses::AUTHORIZED_AND_CANCELLED, Core_Statuses::CANCELLED ),
			array( Statuses::AUTHORIZED_AND_CANCELLED_64, Core_Statuses::CANCELLED ),
			// Open
			array( Statuses::ORDER_STORED, Core_Statuses::OPEN ),
			array( Statuses::STORED_WAITING_EXTERNAL_RESULT, Core_Statuses::OPEN ),
			array( Statuses::WAITING_CLIENT_PAYMENT, Core_Statuses::OPEN ),
			array( Statuses::AUHTORIZED_WAITING_EXTERNAL_RESULT, Core_Statuses::OPEN ),
			array( Statuses::AUTHORIZATION_WAITING, Core_Statuses::OPEN ),
			array( Statuses::AUTHORIZATION_NOT_KNOWN, Core_Statuses::OPEN ),
			array( Statuses::STAND_BY, Core_Statuses::OPEN ),
			array( Statuses::OK_WITH_SCHEDULED_PAYMENTS, Core_Statuses::OPEN ),
			array( Statuses::ERROR_IN_SCHEDULED_PAYMENTS, Core_Statuses::OPEN ),
			array( Statuses::AUHORIZ_TO_GET_MANUALLY, Core_Statuses::OPEN ),
			array( Statuses::AUTHOR_DELETION_WAITING, Core_Statuses::OPEN ),
			array( Statuses::AUTHOR_DELETION_UNCERTAIN, Core_Statuses::OPEN ),
			array( Statuses::PAYMENT_DELETION_PENDING, Core_Statuses::OPEN ),
			array( Statuses::PAYMENT_DELETION_UNCERTAIN, Core_Statuses::OPEN ),
			array( Statuses::PAYMENT_DELETED_74, Core_Statuses::OPEN ),
			array( Statuses::DELETION_PROCESSED_BY_MERCHANT, Core_Statuses::OPEN ),
			array( Statuses::REFUND_PENDING, Core_Statuses::OPEN ),
			array( Statuses::REFUND_UNCERTAIN, Core_Statuses::OPEN ),
			array( Statuses::PAYMENT_UNCERTAIN, Core_Statuses::OPEN ),
			array( Statuses::PAYMENT_PROCESSING, Core_Statuses::OPEN ),
			array( Statuses::BEING_PROCESSED, Core_Statuses::OPEN ),
			// Success
			array( Statuses::AUTHORIZED, Core_Statuses::SUCCESS ),
			array( Statuses::PAYMENT_DELETED, Core_Statuses::SUCCESS ),
			array( Statuses::REFUND, Core_Statuses::SUCCESS ),
			array( Statuses::REFUND_PROCESSED_BY_MERCHANT, Core_Statuses::SUCCESS ),
			array( Statuses::PAYMENT_REQUESTED, Core_Statuses::SUCCESS ),
			array( Statuses::PAYMENT_PROCESSED_BY_MERCHANT, Core_Statuses::SUCCESS ),
			// Other
			array( 'not existing status', null ),
		);
	}
}
