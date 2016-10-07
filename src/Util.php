<?php

/**
 * Title: Ogone utility
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.0
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_Util {
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
