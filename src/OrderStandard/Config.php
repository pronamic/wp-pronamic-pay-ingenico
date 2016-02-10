<?php

/**
 * Title: Ogone OrderStandard config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Config extends Pronamic_WP_Pay_Gateways_Ogone_Config {
	public $hash_algorithm;

	public $sha_in_pass_phrase;

	public $sha_out_pass_phrase;

	public function get_payment_server_url() {
		return 'https://secure.ogone.com/ncol/prod/orderstandard.asp';
	}
}
