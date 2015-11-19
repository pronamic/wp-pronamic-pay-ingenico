<?php

abstract class Pronamic_WP_Pay_Gateways_Ogone_AbstractIntegration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function __construct() {
		$this->url      = 'https://secure.ogone.com/';
		$this->provider = 'ogone';
	}

	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_Settings';
	}
}
