<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Payments\PaymentStatus as Core_Statuses;

/**
 * Title: Ogone statuses constants tests
 * Description:
 * Copyright: 2005-2022 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.4
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
		return [
			// Failture
			[ Statuses::INCOMPLETE_OR_INVALID, Core_Statuses::FAILURE ],
			[ Statuses::AUTHORIZATION_REFUSED, Core_Statuses::FAILURE ],
			[ Statuses::AUTHOR_DELETION_REFUSED, Core_Statuses::FAILURE ],
			[ Statuses::PAYMENT_DELETION_REFUSED, Core_Statuses::FAILURE ],
			[ Statuses::REFUND_REFUSED, Core_Statuses::FAILURE ],
			[ Statuses::PAYMENT_DECLIEND_BY_THE_ACQUIRER, Core_Statuses::FAILURE ],
			[ Statuses::PAYMENT_REFUSED, Core_Statuses::FAILURE ],
			[ Statuses::REFUND_DECLINED_BY_THE_ACQUIRER, Core_Statuses::FAILURE ],
			// Cancelled
			[ Statuses::CANCELLED_BY_CLIENT, Core_Statuses::CANCELLED ],
			[ Statuses::AUTHORIZED_AND_CANCELLED, Core_Statuses::CANCELLED ],
			[ Statuses::AUTHORIZED_AND_CANCELLED_64, Core_Statuses::CANCELLED ],
			// Open
			[ Statuses::ORDER_STORED, Core_Statuses::OPEN ],
			[ Statuses::STORED_WAITING_EXTERNAL_RESULT, Core_Statuses::OPEN ],
			[ Statuses::WAITING_CLIENT_PAYMENT, Core_Statuses::OPEN ],
			[ Statuses::AUHTORIZED_WAITING_EXTERNAL_RESULT, Core_Statuses::OPEN ],
			[ Statuses::AUTHORIZATION_WAITING, Core_Statuses::OPEN ],
			[ Statuses::AUTHORIZATION_NOT_KNOWN, Core_Statuses::OPEN ],
			[ Statuses::STAND_BY, Core_Statuses::OPEN ],
			[ Statuses::OK_WITH_SCHEDULED_PAYMENTS, Core_Statuses::OPEN ],
			[ Statuses::ERROR_IN_SCHEDULED_PAYMENTS, Core_Statuses::OPEN ],
			[ Statuses::AUHORIZ_TO_GET_MANUALLY, Core_Statuses::OPEN ],
			[ Statuses::AUTHOR_DELETION_WAITING, Core_Statuses::OPEN ],
			[ Statuses::AUTHOR_DELETION_UNCERTAIN, Core_Statuses::OPEN ],
			[ Statuses::PAYMENT_DELETION_PENDING, Core_Statuses::OPEN ],
			[ Statuses::PAYMENT_DELETION_UNCERTAIN, Core_Statuses::OPEN ],
			[ Statuses::PAYMENT_DELETED_74, Core_Statuses::OPEN ],
			[ Statuses::DELETION_PROCESSED_BY_MERCHANT, Core_Statuses::OPEN ],
			[ Statuses::REFUND_PENDING, Core_Statuses::OPEN ],
			[ Statuses::REFUND_UNCERTAIN, Core_Statuses::OPEN ],
			[ Statuses::PAYMENT_UNCERTAIN, Core_Statuses::OPEN ],
			[ Statuses::PAYMENT_PROCESSING, Core_Statuses::OPEN ],
			[ Statuses::BEING_PROCESSED, Core_Statuses::OPEN ],
			// Success
			[ Statuses::AUTHORIZED, Core_Statuses::SUCCESS ],
			[ Statuses::PAYMENT_DELETED, Core_Statuses::SUCCESS ],
			[ Statuses::REFUND, Core_Statuses::SUCCESS ],
			[ Statuses::REFUND_PROCESSED_BY_MERCHANT, Core_Statuses::SUCCESS ],
			[ Statuses::PAYMENT_REQUESTED, Core_Statuses::SUCCESS ],
			[ Statuses::PAYMENT_PROCESSED_BY_MERCHANT, Core_Statuses::SUCCESS ],
			// Other
			[ 'not existing status', null ],
		];
	}
}
