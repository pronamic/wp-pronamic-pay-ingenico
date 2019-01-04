<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

/**
 * Title: Ingenico OrderStandard test config
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class TestConfig extends Config {
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
