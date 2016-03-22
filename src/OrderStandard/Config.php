<?php

/**
 * Title: Ogone OrderStandard config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.2.8
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Config extends Pronamic_WP_Pay_Gateways_Ogone_Config {
	public $hash_algorithm;

	public $sha_in_pass_phrase;

	public $sha_out_pass_phrase;

	public function get_payment_server_url() {
		$is_utf8 = strcasecmp( get_bloginfo( 'charset' ), 'UTF-8' ) === 0;

		if ( $is_utf8 ) {
			return 'https://secure.ogone.com/ncol/prod/orderstandard_utf8.asp';
		} else {
			return 'https://secure.ogone.com/ncol/prod/orderstandard.asp';
		}
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Gateway';
	}
}
