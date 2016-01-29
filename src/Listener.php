<?php

/**
 * Title: OmniKassa listener
* Description:
* Copyright: Copyright (c) 2005 - 2015
* Company: Pronamic
 *
* @author Remco Tolsma
* @version 1.0.0
*/
class Pronamic_WP_Pay_Gateways_Ogone_Listener implements Pronamic_Pay_Gateways_ListenerInterface {
	public static function listen() {
		$data = Pronamic_WP_Pay_Gateways_Ogone_Security::get_request_data();

		$data = array_change_key_case( $data, CASE_UPPER );

		if ( isset(
			$data[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::NC_ERROR ],
			$data['PAYID'],
			$data[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID ],
			$data[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::STATUS ]
		) ) {
			$payment_id = $data[ Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID ];

			$payment = get_pronamic_payment( $payment_id );

			Pronamic_WP_Pay_Plugin::update_payment( $payment );
		}
	}
}
