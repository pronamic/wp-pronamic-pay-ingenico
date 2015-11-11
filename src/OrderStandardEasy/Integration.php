<?php

class Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Integration {
	public function __construct() {
		$this->id       = 'ogone-easy';
		$this->name     = 'Ingenico/Ogone - Easy';
		$this->url      = 'https://secure.ogone.com/';
		$this->provider = 'ogone';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Gateway';
	}
}
