<?php

/**
 * Title: Ogone utility
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_Util {
	/**
	 * Get order ID
	 *
	 * @param string $status
	 */
	public static function get_order_id( $order_id, $data, $payment ) {
		// Find and replace
		// @see https://github.com/woothemes/woocommerce/blob/v2.0.19/classes/emails/class-wc-email-new-order.php
		$find    = array();
		$replace = array();

		$find[]    = '{order_id}';
		$replace[] = $data->get_order_id();

		$find[]    = '{payment_id}';
		$replace[] = $payment->get_id();

		// Order ID
		$order_id = str_replace( $find, $replace, $order_id, $count );

		// Make sure there is an dynamic part in the order ID
		// @see https://secure.ogone.com/ncol/param_cookbook.asp
		if ( 0 == $count ) {
			$order_id .= $payment->get_id();
		}

		// Return
		return $order_id;
	}

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

		// Return
		return $param_var;
	}
}
