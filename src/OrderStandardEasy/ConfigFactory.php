<?php

/**
 * Title: Ogone order standard easy config factory
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_ConfigFactory extends Pronamic_WP_Pay_GatewayConfigFactory {
	public function get_config( $post_id ) {
		$config = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandardEasy_Config();

		$config->psp_id   = get_post_meta( $post_id, '_pronamic_gateway_ogone_psp_id', true );
		$config->mode     = get_post_meta( $post_id, '_pronamic_gateway_mode', true );
		$config->order_id = get_post_meta( $post_id, '_pronamic_gateway_ogone_order_id', true );

		$gateway_id = get_post_meta( $post_id, '_pronamic_gateway_id', true );
		$mode       = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		global $pronamic_pay_gateways;

		$gateway  = $pronamic_pay_gateways[ $gateway_id ];
		$settings = $gateway[ $mode ];

		$url = $settings['payment_server_url'];

		$config->url = $url;

		return $config;
	}
}
