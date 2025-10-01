<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\AbstractGatewayIntegration;

abstract class AbstractIntegration extends AbstractGatewayIntegration {
	/**
	 * Constructor.
	 *
	 * @param array<string, mixed> $args Arguments.
	 */
	public function __construct( $args = [] ) {
		$args = wp_parse_args(
			$args,
			[
				'id'            => null,
				'name'          => null,
				'url'           => 'https://secure.ogone.com/',
				'product_url'   => 'https://worldline.com/',
				'manual_url'    => 'https://www.pronamicpay.com/en/manuals/how-to-connect-ingenico-to-wordpress-with-pronamic-pay/',
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
