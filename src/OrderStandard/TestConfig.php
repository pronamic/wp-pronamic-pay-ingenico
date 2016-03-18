<?php

/**
 * Title: Ogone OrderStandard test config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_TestConfig extends Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Config {
	public function get_payment_server_url() {
		$is_utf8 = strcasecmp( get_bloginfo( 'charset' ), 'UTF-8' ) === 0;

		if ( $is_utf8 ) {
			return 'https://secure.ogone.com/ncol/test/orderstandard_utf8.asp';
		} else {
			return 'https://secure.ogone.com/ncol/test/orderstandard.asp';
		}		
	}
}
