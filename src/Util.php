<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico utility
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Util {
	/**
	 * Get parameter variable
	 *
	 * @param string $param_var
	 */
	public static function get_param_var( $param_var ) {
		// Find and replace
		// @see https://github.com/woothemes/woocommerce/blob/v2.0.19/classes/emails/class-wc-email-new-order.php
		$find    = array();
		$replace = array();

		$find[]    = '{site_url}';
		$replace[] = site_url();

		$find[]    = '{home_url}';
		$replace[] = home_url();

		// Parameter Variable
		$param_var = str_replace( $find, $replace, $param_var );

		return $param_var;
	}
}
