<?php

class Pronamic_WP_Pay_Gateways_Ogone_DirectLink_GatewayIntegration {
	public function __construct() {
		$this->id = 'ogone-directlink';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_DirectLink_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Config';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Gateway';
	}
}
