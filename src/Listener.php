<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Plugin;

/**
 * Title: OmniKassa listener
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Listener {
	public static function listen() {
		$data = Security::get_request_data();

		$data = array_change_key_case( $data, CASE_UPPER );

		if ( isset(
			$data[ Parameters::NC_ERROR ],
			$data['PAYID'],
			$data[ Parameters::ORDERID ],
			$data[ Parameters::STATUS ]
		) ) {
			$payment_id = $data[ Parameters::ORDERID ];

			if ( isset( $data['PAYMENT_ID'] ) ) {
				$payment_id = filter_var( $data['PAYMENT_ID'], FILTER_SANITIZE_NUMBER_INT );
			}

			$payment = get_pronamic_payment( $payment_id );

			// Add note.
			$payment->add_note( __( 'Webhook requested.', 'pronamic_ideal' ) );

			// Update payment.
			Plugin::update_payment( $payment );
		}
	}
}
