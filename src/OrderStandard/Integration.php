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
	public function __construct( $args = [] ) {
		$args = wp_parse_args(
			$args,
			[
				'id'               => 'ogone-orderstandard',
				'name'             => 'Ingenico/Ogone - e-Commerce',
				'action_url'       => 'https://secure.ogone.com/ncol/prod/orderstandard.asp',
				'direct_query_url' => 'https://secure.ogone.com/ncol/prod/querydirect.asp',
			]
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
		return Settings::get_settings_fields();
	}

	/**
	 * Get configuration.
	 *
	 * @param int $post_id Post ID.
	 * @return Config
	 */
	public function get_config( $post_id ) {
		$config = new Config();

		$config->mode = $this->get_mode();

		$config->set_form_action_url( $this->action_url );
		$config->set_direct_query_url( $this->direct_query_url );

		$form_action_url = $this->get_meta( $post_id, '_pronamic_gateway_ogone_form_action_url' );

		if ( '' !== $form_action_url ) {
			$config->set_form_action_url( $form_action_url );
		}

		$config->psp_id              = $this->get_meta( $post_id, 'ogone_psp_id' );
		$config->hash_algorithm      = $this->get_meta( $post_id, 'ogone_hash_algorithm' );
		$config->sha_in_pass_phrase  = $this->get_meta( $post_id, 'ogone_sha_in_pass_phrase' );
		$config->sha_out_pass_phrase = $this->get_meta( $post_id, 'ogone_sha_out_pass_phrase' );
		$config->user_id             = $this->get_meta( $post_id, 'ogone_user_id' );
		$config->password            = $this->get_meta( $post_id, 'ogone_password' );
		$config->order_id            = $this->get_meta( $post_id, 'ogone_order_id' );
		$config->complus             = $this->get_meta( $post_id, 'ogone_complus' );
		$config->param_var           = $this->get_meta( $post_id, 'ogone_param_var' );
		$config->template_page       = $this->get_meta( $post_id, 'ogone_template_page' );
		$config->alias_enabled       = $this->get_meta( $post_id, 'ogone_alias_enabled' );
		$config->alias_usage         = $this->get_meta( $post_id, 'ogone_alias_usage' );

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

		return $gateway;
	}
}
