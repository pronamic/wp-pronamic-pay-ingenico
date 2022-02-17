<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

use Pronamic\WordPress\Pay\Gateways\Ingenico\AbstractIntegration;
use Pronamic\WordPress\Pay\Gateways\Ingenico\Settings;

class Integration extends AbstractIntegration {
	/**
	 * Action URL.
	 * 
	 * @var string
	 */
	private $action_url;

	/**
	 * Direct query URL.
	 *
	 * @var string
	 */
	private $direct_query_url;

	/**
	 * Integration constructor.
	 *
	 * @param array<string, string> $args Arguments.
	 * @return void
	 */
	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'               => 'ogone-orderstandard',
				'name'             => 'Ingenico/Ogone - e-Commerce',
				'action_url'       => 'https://secure.ogone.com/ncol/prod/orderstandard.asp',
				'direct_query_url' => 'https://secure.ogone.com/ncol/prod/querydirect.asp',
			)
		);

		parent::__construct( $args );

		$this->action_url       = $args['action_url'];
		$this->direct_query_url = $args['direct_query_url'];
	}

	/**
	 * Get settings fields.
	 *
	 * @return array
	 */
	public function get_settings_fields() {
		return Settings::get_settings_fields( 'standard' );
	}

	public function get_config( $post_id ) {
		$config = new Config();

		$config->set_form_action_url( $this->action_url );
		$config->set_direct_query_url( $this->direct_query_url );

		$form_action_url = get_post_meta( $post_id, '_pronamic_gateway_ogone_form_action_url', true );

		if ( '' !== $form_action_url ) {
			$config->set_form_action_url( $form_action_url );
		}

		$config->psp_id              = get_post_meta( $post_id, '_pronamic_gateway_ogone_psp_id', true );
		$config->hash_algorithm      = get_post_meta( $post_id, '_pronamic_gateway_ogone_hash_algorithm', true );
		$config->sha_in_pass_phrase  = get_post_meta( $post_id, '_pronamic_gateway_ogone_sha_in_pass_phrase', true );
		$config->sha_out_pass_phrase = get_post_meta( $post_id, '_pronamic_gateway_ogone_sha_out_pass_phrase', true );
		$config->user_id             = get_post_meta( $post_id, '_pronamic_gateway_ogone_user_id', true );
		$config->password            = get_post_meta( $post_id, '_pronamic_gateway_ogone_password', true );
		$config->order_id            = get_post_meta( $post_id, '_pronamic_gateway_ogone_order_id', true );
		$config->param_var           = get_post_meta( $post_id, '_pronamic_gateway_ogone_param_var', true );
		$config->template_page       = get_post_meta( $post_id, '_pronamic_gateway_ogone_template_page', true );
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
