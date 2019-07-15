<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Gateways\Common\AbstractIntegration as Common_AbstractIntegration;

abstract class AbstractIntegration extends Common_AbstractIntegration {
	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'            => null,
				'name'          => null,
				'url'           => 'https://secure.ogone.com/',
				'product_url'   => __( 'https://payment-services.ingenico.com/nl/en', 'pronamic_ideal' ),
				'dashboard_url' => 'https://secure.ogone.com/',
				'provider'      => 'ogone',
			)
		);

		$this->id            = $args['id'];
		$this->name          = $args['name'];
		$this->url           = $args['url'];
		$this->product_url   = $args['product_url'];
		$this->dashboard_url = $args['dashboard_url'];
		$this->provider      = $args['provider'];

		// Supports.
		$this->supports = array(
			'webhook',
			'webhook_log',
		);

		// Actions.
		$function = array( __NAMESPACE__ . '\Listener', 'listen' );

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}
}
