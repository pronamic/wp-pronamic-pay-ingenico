<?php

abstract class Pronamic_WP_Pay_Gateways_Ogone_AbstractIntegration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function __construct() {
		$this->url           = 'https://secure.ogone.com/';
		$this->product_url   = __( 'https://payment-services.ingenico.com/nl/en', 'pronamic_ideal' );
		$this->dashboard_url = 'https://secure.ogone.com/';
		$this->provider      = 'ogone';

		// Actions
		$function = array( 'Pronamic_WP_Pay_Gateways_Ogone_Listener', 'listen' );

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}

	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_Settings';
	}
}
