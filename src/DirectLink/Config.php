<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Pay\Gateways\Ingenico\Config as Ingenico_Config;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

/**
 * Title: Ingenico DirectLink config
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 */
class Config extends Ingenico_Config {
	public $user_id;

	public $password;

	public $sha_in_pass_phrase;

	public $api_url;

	/**
	 * Constructs and initializes an Ogone DirectLink config object
	 */
	public function __construct() {
		$this->api_url = DirectLink::API_PRODUCTION_URL;
	}
}
