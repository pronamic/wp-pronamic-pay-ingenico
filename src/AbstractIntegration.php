<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\AbstractGatewayIntegration;

abstract class AbstractIntegration extends AbstractGatewayIntegration {
	public function __construct( $args = [] ) {
		$args = wp_parse_args(
			$args,
			[
				'id'            => null,
				'name'          => null,
				'url'           => 'https://secure.ogone.com/',
				'product_url'   => \__( 'https://payment-services.ingenico.com/nl/en', 'pronamic_ideal' ),
				'manual_url'    => \__( 'https://www.pronamicpay.com/en/manuals/how-to-connect-ingenico-to-wordpress-with-pronamic-pay/', 'pronamic_ideal' ),
				'dashboard_url' => 'https://secure.ogone.com/',
				'provider'      => 'ogone',
				'supports'      => [
					'webhook',
					'webhook_log',
				],
			]
		);

		parent::__construct( $args );

		// Actions.
		$function = [ __NAMESPACE__ . '\Listener', 'listen' ];

		if ( ! has_action( 'wp_loaded', $function ) ) {
			add_action( 'wp_loaded', $function );
		}
	}
}
