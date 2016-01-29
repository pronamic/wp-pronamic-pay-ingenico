<?php

/**
 * Title: Ogone gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.0
 * @since 1.3.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_Settings extends Pronamic_WP_Pay_GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// General
		$sections['ogone'] = array(
			'title'   => __( 'Ogone', 'pronamic_ideal' ),
			'methods' => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Direct HTTP server-to-server request
		$sections['ogone_direct'] = array(
			'title'   => __( 'Direct HTTP server-to-server request', 'pronamic_ideal' ),
			'methods' => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Payment page look and feel
		$sections['ogone_look'] = array(
			'title'   => __( 'Payment page look and feel', 'pronamic_ideal' ),
			'methods' => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// DirectLink
		$sections['ogone_directlink'] = array(
			'title'   => __( 'DirectLink', 'pronamic_ideal' ),
			'methods' => array( 'ogone_directlink' ),
		);

		// Return
		return $sections;
	}

	public function fields( array $fields ) {
		/*
		 * General
		 */

		// PSPID
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_psp_id',
			'title'       => __( 'PSPID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'code' ),
			'description' => sprintf(
				__( 'If you use the ABN AMRO - IDEAL Easy variant you can use <code>%s</code>.', 'pronamic_ideal' ),
				'TESTiDEALEASY'
			),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Character encoding
		$fields[] = array(
			'section'     => 'ogone',
			'title'       => __( 'Character encoding', 'pronamic_ideal' ),
			'type'        => 'text',
			'value'       => get_bloginfo( 'charset' ),
			'methods'     => array( 'ogone_orderstandard' ),
			'readonly'    => true,
		);

		// Hash algorithm
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_hash_algorithm',
			'title'       => __( 'Hash algorithm', 'pronamic_ideal' ),
			'type'        => 'optgroup',
			'options'     => array(
				Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_1   => __( 'SHA-1', 'pronamic_ideal' ),
				Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_256 => __( 'SHA-256', 'pronamic_ideal' ),
				Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_512 => __( 'SHA-512', 'pronamic_ideal' ),
			),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// SHA-IN Pass phrase
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_sha_in_pass_phrase',
			'title'       => __( 'SHA-IN Pass phrase', 'pronamic_ideal' ),
			'type'        => 'password',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'You configure the SHA-IN Pass phrase in the iDEAL dashboard (Configuration &raquo; Technical information &raquo; Data and origin verification) of your iDEAL provider.', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard' ),
		);

		// SHA-OUT Pass phrase
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_sha_out_pass_phrase',
			'title'       => __( 'SHA-OUT Pass phrase', 'pronamic_ideal' ),
			'type'        => 'password',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'You configure the SHA-OUT Pass phrase in the iDEAL dashboard (Configuration &raquo; Technical information &raquo; Transaction feedback) of your iDEAL provider.', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// User ID
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_user_id',
			'title'       => __( 'User ID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'methods'     => array( 'ogone_directlink' ),
		);

		// Password
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_password',
			'title'       => __( 'Password', 'pronamic_ideal' ),
			'type'        => 'password',
			'classes'     => array( 'regular-text', 'code' ),
			'methods'     => array( 'ogone_directlink' ),
		);

		// Order ID
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_order_id',
			'title'       => __( 'Order ID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => sprintf(
				'%s<br />%s<br />%s',
				sprintf(
					__( 'This controls the Ogone %s parameter.', 'pronamic_ideal' ),
					sprintf( '<code>%s</code>', 'ORDERID' )
				),
				sprintf( __( 'Default: <code>%s</code>.', 'pronamic_ideal' ), '{payment_id}' ),
				sprintf( __( 'Tags: %s', 'pronamic_ideal' ), sprintf( '<code>%s</code> <code>%s</code>', '{order_id}', '{payment_id}' ) )
			),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		/*
		 * Direct HTTP server-to-server request
		 */

		// URL accepted, on hold or uncertain
		$fields[] = array(
			'section'     => 'ogone_direct',
			'title'       => __( 'URL accepted, on hold or uncertain', 'pronamic_ideal' ),
			'type'        => 'text',
			'value'       => site_url( '/' ),
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'If the payment\'s status is "accepted", "on hold" or "uncertain".', 'pronamic_ideal' ),
			'readonly'    => true,
		);

		// URL cancel or deny
		$fields[] = array(
			'section'     => 'ogone_direct',
			'title'       => __( 'URL cancel or deny', 'pronamic_ideal' ),
			'type'        => 'text',
			'value'       => site_url( '/' ),
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'If the payment\'s status is "cancelled by the client" or "too many rejections by the acquirer".', 'pronamic_ideal' ),
			'readonly'    => true,
		);

		// Parameter Variable
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_direct',
			'meta_key'    => '_pronamic_gateway_ogone_param_var',
			'title'       => __( 'Parameter Variable', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => sprintf(
				'%s<br />%s',
				sprintf(
					__( 'This controls the Ogone %s parameter.', 'pronamic_ideal' ),
					sprintf( '<code>%s</code>', 'PARAMVAR' )
				),
				sprintf( __( 'Tags: %s', 'pronamic_ideal' ), sprintf( '<code>%s</code> <code>%s</code>', '{site_url}', '{home_url}' ) )
			),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		/*
		 * Payment page look and feel
		 */

		// Template Page
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_look',
			'meta_key'    => '_pronamic_gateway_ogone_template_page',
			'title'       => __( 'Template Page', 'pronamic_ideal' ),
			'type'        => 'text',
			'description' => sprintf(
				__( 'This controls the Ogone %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'TP' )
			),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		/*
		 * DirectLink
		 */

		// SHA-IN Pass phrase
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_directlink',
			'meta_key'    => '_pronamic_gateway_ogone_directlink_sha_in_pass_phrase',
			'title'       => __( 'SHA-IN Pass phrase', 'pronamic_ideal' ),
			'type'        => 'password',
			'classes'     => array( 'regular-text', 'code' ),
			'description' => __( 'You configure the SHA-IN Pass phrase in the iDEAL dashboard (Configuration &raquo; Technical information &raquo; Data and origin verification) of your iDEAL provider.', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_directlink' ),
		);

		// 3-D Secure
		$fields[] = array(
			'filter'      => FILTER_VALIDATE_BOOLEAN,
			'section'     => 'ogone_directlink',
			'meta_key'    => '_pronamic_gateway_ogone_3d_secure_enabled',
			'title'       => __( '3-D Secure', 'pronamic_ideal' ),
			'type'        => 'checkbox',
			'label'       => __( 'Enable 3-D Secure protocol', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_directlink' ),
		);

		// Return
		return $fields;
	}
}
