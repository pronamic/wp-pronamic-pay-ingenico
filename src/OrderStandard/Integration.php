<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

use Pronamic\WordPress\Pay\Gateways\Ingenico\AbstractIntegration;

class Integration extends AbstractIntegration {
	public function __construct() {
		parent::__construct();

		$this->id   = 'ogone-orderstandard';
		$this->name = 'Ingenico/Ogone - e-Commerce';
	}

	public function get_config_factory_class() {
		return __NAMESPACE__ . '\ConfigFactory';
	}

	/**
	 * Get required settings for this integration.
	 *
	 * @link https://github.com/wp-premium/gravityforms/blob/1.9.16/includes/fields/class-gf-field-multiselect.php#L21-L42
	 * @since 1.1.3
	 * @return array
	 */
	public function get_settings() {
		$settings = parent::get_settings();

		$settings[] = 'ogone_orderstandard';

		return $settings;
	}
}
