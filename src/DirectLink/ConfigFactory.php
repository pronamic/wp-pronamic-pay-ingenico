<?php

/**
 * Title: Ogone DirectLink config factory
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DirectLink_ConfigFactory extends Pronamic_WP_Pay_GatewayConfigFactory {
	public function get_config( $post_id ) {
		$config = new Pronamic_WP_Pay_Gateways_Ogone_DirectLink_Config();

		$config->mode                = get_post_meta( $post_id, '_pronamic_gateway_mode', true );
		$config->psp_id              = get_post_meta( $post_id, '_pronamic_gateway_ogone_psp_id', true );
		$config->hash_algorithm      = get_post_meta( $post_id, '_pronamic_gateway_ogone_hash_algorithm', true );
		$config->sha_out_pass_phrase = get_post_meta( $post_id, '_pronamic_gateway_ogone_sha_out_pass_phrase', true );
		$config->user_id             = get_post_meta( $post_id, '_pronamic_gateway_ogone_user_id', true );
		$config->password            = get_post_meta( $post_id, '_pronamic_gateway_ogone_password', true );
		$config->sha_in_pass_phrase  = get_post_meta( $post_id, '_pronamic_gateway_ogone_directlink_sha_in_pass_phrase', true );
		$config->enabled_3d_secure   = get_post_meta( $post_id, '_pronamic_gateway_ogone_3d_secure_enabled', true );
		$config->order_id            = get_post_meta( $post_id, '_pronamic_gateway_ogone_order_id', true );

		// API URL
		$is_utf8 = strcasecmp( get_bloginfo( 'charset' ), 'UTF-8' ) === 0;

		if ( $is_utf8 ) {
			$config->api_url = Pronamic_WP_Pay_Gateways_Ogone_DirectLink::API_PRODUCTION_UTF8_URL;
		} else {
			$config->api_url = Pronamic_WP_Pay_Gateways_Ogone_DirectLink::API_PRODUCTION_URL;
		}

		if ( Pronamic_IDeal_IDeal::MODE_TEST === $config->mode ) {
			if ( $is_utf8 ) {
				$config->api_url = Pronamic_WP_Pay_Gateways_Ogone_DirectLink::API_TEST_UTF8_URL;
			} else {
				$config->api_url = Pronamic_WP_Pay_Gateways_Ogone_DirectLink::API_TEST_URL;
			}
		}

		return $config;
	}
}
