<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Pay\Gateways\Ingenico\AbstractIntegration;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Settings;

class Integration extends AbstractIntegration {
	public function __construct() {
		parent::__construct();

		$this->id   = 'ogone-directlink';
		$this->name = 'Ingenico/Ogone - DirectLink';
	}

	public function get_config_factory_class() {
		return __NAMESPACE__ . '\ConfigFactory';
	}

	public function get_settings_fields() {
		return Settings::get_settings_fields( 'directlink' );
	}
}
