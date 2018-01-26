<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Gateways\Common\AbstractIntegration as Common_AbstractIntegration;

abstract class AbstractIntegration extends Common_AbstractIntegration {
	public function __construct() {
		$this->url           = 'https://secure.ogone.com/';
		$this->product_url   = __( 'https://payment-services.ingenico.com/nl/en', 'pronamic_ideal' );
		$this->dashboard_url = 'https://secure.ogone.com/';
		$this->provider      = 'ogone';

		// Actions
		$function = array( __NAMESPACE__ . '\Listener', 'listen' );

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}

	public function get_settings_class() {
		return __NAMESPACE__ . '\Settings';
	}
}
