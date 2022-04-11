<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Pay\Gateways\Ingenico\AbstractIntegration;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Settings;

class Integration extends AbstractIntegration {
	/**
	 * API URL.
	 * 
	 * @var string
	 */
	private $api_url;

	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'      => 'ogone-directlink',
				'name'    => 'Ingenico/Ogone - DirectLink',
				'api_url' => DirectLink::API_PRODUCTION_URL,
			)
		);

		parent::__construct( $args );

		$this->api_url = $args['api_url'];
	}

	public function get_settings_fields() {
		return Settings::get_settings_fields( 'directlink' );
	}

	public function get_config( $post_id ) {
		$config = new Config();

		$config->api_url = $this->api_url;

		$config->psp_id              = get_post_meta( $post_id, '_pronamic_gateway_ogone_psp_id', true );
		$config->hash_algorithm      = get_post_meta( $post_id, '_pronamic_gateway_ogone_hash_algorithm', true );
		$config->sha_out_pass_phrase = get_post_meta( $post_id, '_pronamic_gateway_ogone_sha_out_pass_phrase', true );
		$config->user_id             = get_post_meta( $post_id, '_pronamic_gateway_ogone_user_id', true );
		$config->password            = get_post_meta( $post_id, '_pronamic_gateway_ogone_password', true );
		$config->sha_in_pass_phrase  = get_post_meta( $post_id, '_pronamic_gateway_ogone_directlink_sha_in_pass_phrase', true );
		$config->enabled_3d_secure   = get_post_meta( $post_id, '_pronamic_gateway_ogone_3d_secure_enabled', true );
		$config->order_id            = get_post_meta( $post_id, '_pronamic_gateway_ogone_order_id', true );
		$config->alias_enabled       = get_post_meta( $post_id, '_pronamic_gateway_ogone_alias_enabled', true );
		$config->alias_usage         = get_post_meta( $post_id, '_pronamic_gateway_ogone_alias_usage', true );

		return $config;
	}

	/**
	 * Get gateway.
	 *
	 * @param int $post_id Post ID.
	 * @return Gateway
	 */
	public function get_gateway( $post_id ) {
		$gateway = new Gateway( $this->get_config( $post_id ) );

		$gateway->set_mode( $this->get_mode() );

		return $gateway;
	}
}
