<?php

/**
 * Title: Ogone config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_Config extends Pronamic_WP_Pay_GatewayConfig {
	/**
	 * Ogone PSPID.
	 *
	 * The PSPID is the unique identifier of your Ogone account. It is the ID you chose (or were given) at the
	 * registration of your Ogone account, and which you usually login with.
	 *
	 * When configured in your shopping cart, our system will use the PSPID to identify you as a registered merchant.
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/user%20guides/shopping-carts/what-is-a-pspid
	 * @var string
	 */
	public $psp_id;

	/**
	 * Constructs and initializes Ogone config object.
	 */
	public function __construct() {
		$this->pspd_id = null;
	}
}
