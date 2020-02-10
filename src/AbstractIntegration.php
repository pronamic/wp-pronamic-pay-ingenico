<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\AbstractGatewayIntegration;

abstract class AbstractIntegration extends AbstractGatewayIntegration {
	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'            => null,
				'name'          => null,
				'url'           => 'https://secure.ogone.com/',
				'product_url'   => \__( 'https://payment-services.ingenico.com/nl/en', 'pronamic_ideal' ),
				'manual_url'    => \__( 'https://www.pronamic.eu/support/how-to-connect-ingenico-with-wordpress-via-pronamic-pay/', 'pronamic_ideal' ),
				'dashboard_url' => 'https://secure.ogone.com/',
				'provider'      => 'ogone',
				'supports'      => array(
					'webhook',
					'webhook_log',
				),
			)
		);

		parent::__construct( $args );

		// Actions.
		$function = array( __NAMESPACE__ . '\Listener', 'listen' );

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}
}
