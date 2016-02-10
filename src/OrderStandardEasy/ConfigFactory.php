<?php

/**
 * Title: Ogone order standard easy config factory
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_ConfigFactory extends Pronamic_WP_Pay_GatewayConfigFactory {
	private $config_class;

	public function __construct( $config_class = 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config', $config_test_class = 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config' ) {
		$this->config_class      = $config_class;
		$this->config_test_class = $config_test_class;
	}

	public function get_config( $post_id ) {
		$mode = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		$config_class = ( 'test' === $mode ) ? $this->config_test_class : $this->config_class;

		$config = new $config_class();

		$config->psp_id   = get_post_meta( $post_id, '_pronamic_gateway_ogone_psp_id', true );
		$config->mode     = get_post_meta( $post_id, '_pronamic_gateway_mode', true );
		$config->order_id = get_post_meta( $post_id, '_pronamic_gateway_ogone_order_id', true );

		return $config;
	}
}
