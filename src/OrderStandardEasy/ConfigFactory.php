<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandardEasy;

use Pronamic\WordPress\Pay\Core\GatewayConfigFactory;

/**
 * Title: Ingenico order standard easy config factory
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class ConfigFactory extends GatewayConfigFactory {
	private $config_class;

	public function __construct( $config_class = null, $config_test_class = null ) {
		$this->config_class      = is_null( $config_class ) ? __NAMESPACE__ . '\Config' : $config_class;
		$this->config_test_class = is_null( $config_test_class ) ? __NAMESPACE__ . '\Config' : $config_test_class;
	}

	public function get_config( $post_id ) {
		$mode = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		$config_class = ( Gateway::MODE_TEST === $mode ) ? $this->config_test_class : $this->config_class;

		$config = new $config_class();

		$form_action_url = get_post_meta( $post_id, '_pronamic_gateway_ogone_form_action_url', true );

		if ( '' !== $form_action_url ) {
			$config->set_form_action_url( $form_action_url );
		}

		$config->mode     = $mode;
		$config->psp_id   = get_post_meta( $post_id, '_pronamic_gateway_ogone_psp_id', true );
		$config->order_id = get_post_meta( $post_id, '_pronamic_gateway_ogone_order_id', true );

		return $config;
	}
}
