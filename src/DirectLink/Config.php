<?php

/**
 * Title: Ogone DirectLink config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Config extends Pronamic_WP_Pay_Gateways_Ogone_Config {
	public $user_id;

	public $password;

	public $sha_in_pass_phrase;

	public $api_url;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initializes an Ogone DirectLink config object
	 */
	public function __construct() {
		$this->api_url = Pronamic_WP_Pay_Gateways_Ogone_DirectLink::API_PRODUCTION_URL;
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Gateway';
	}
}
