<?php

/**
 * Title: Ogone OrderStandard test config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.2.9
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_TestConfig extends Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Config {
	/**
	 * Get the default Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @return string
	 */
	protected function get_default_form_action_url() {
		$is_utf8 = strcasecmp( get_bloginfo( 'charset' ), 'UTF-8' ) === 0;

		if ( $is_utf8 ) {
			return 'https://secure.ogone.com/ncol/test/orderstandard_utf8.asp';
		}

		return 'https://secure.ogone.com/ncol/test/orderstandard.asp';
	}
}
