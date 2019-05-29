<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandardEasy;

use Pronamic\WordPress\Pay\Gateways\Ingenico\AbstractIntegration;

class Integration extends AbstractIntegration {
	public function __construct() {
		parent::__construct();

		$this->id   = 'ogone-easy';
		$this->name = 'Ingenico/Ogone - e-Commerce - Easy';
	}

	public function get_config_factory_class() {
		return __NAMESPACE__ . '\ConfigFactory';
	}

	/**
	 * Get settings fields.
	 *
	 * @return array
	 */
	public function get_settings_fields() {
		return Settings::get_settings_fields( 'easy' );
	}
}
