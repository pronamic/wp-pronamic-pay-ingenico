<?php

class Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Integration extends Pronamic_WP_Pay_Gateways_Ogone_AbstractIntegration {
	public function __construct() {
		parent::__construct();

		$this->id       = 'ogone-directlink';
		$this->name     = 'Ingenico/Ogone - DirectLink';
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
