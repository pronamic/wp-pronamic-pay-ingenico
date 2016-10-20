<?php

/**
 * Title: Ogone OrderStandard easy config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config extends Pronamic_WP_Pay_Gateways_Ogone_Config {
	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Gateway';
	}
}
