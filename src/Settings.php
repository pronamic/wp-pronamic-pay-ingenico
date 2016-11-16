<?php

/**
 * Title: Ogone gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.3
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
			'title'       => __( 'Ogone', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
			'description' => __( 'Account details are provided by the payment provider after registration. These settings need to match with the payment provider dashboard.', 'pronamic_ideal' ),
		);

		// Payment page look and feel
		$sections['ogone_advanced'] = array(
			'title'       => __( 'Advanced', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
			'description' => __( 'Optional settings for advanced usage only.', 'pronamic_ideal' ),
		);

		// Direct HTTP server-to-server request
		$sections['ogone_feedback'] = array(
			'title'       => __( 'Transaction feedback', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
			'description' => __( 'The URLs below need to be copied to the payment provider dashboard to receive automatic transaction status updates.', 'pronamic_ideal' ),
		);

		// Return sections
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
			'tooltip'     => __( 'PSPID as mentioned in the payment provider dashboard.', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// API user ID
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_user_id',
			'title'       => __( 'API user ID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
			'tooltip'     => __( 'User ID of the API user in the payment provider dashboard: Configuration &raquo; Users', 'pronamic_ideal' ),
		);

		// API user password
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_password',
			'title'       => __( 'API user password', 'pronamic_ideal' ),
			'type'        => 'password',
			'classes'     => array( 'regular-text', 'code' ),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
			'tooltip'     => __( 'Password of the API user in the payment provider dashboard: Configuration &raquo; Users', 'pronamic_ideal' ),
		);

		// SHA-IN Pass phrase
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ogone',
			'meta_key' => '_pronamic_gateway_ogone_sha_in_pass_phrase',
			'title'    => __( 'SHA-IN Pass phrase', 'pronamic_ideal' ),
			'type'     => 'password',
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'SHA-IN pass phrase as mentioned in the payment provider dashboard: Configuration &raquo; Technical information &raquo; Data and origin verification.', 'pronamic_ideal' ),
			'methods'  => array( 'ogone_orderstandard' ),
		);

		// SHA-IN Pass phrase
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ogone',
			'meta_key' => '_pronamic_gateway_ogone_directlink_sha_in_pass_phrase',
			'title'    => __( 'SHA-IN Pass phrase', 'pronamic_ideal' ),
			'type'     => 'password',
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'SHA-IN pass phrase as mentioned in the payment provider dashboard: Configuration &raquo; Technical information &raquo; Data and origin verification.', 'pronamic_ideal' ),
			'methods'  => array( 'ogone_directlink' ),
		);

		// SHA-OUT Pass phrase
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ogone',
			'meta_key' => '_pronamic_gateway_ogone_sha_out_pass_phrase',
			'title'    => __( 'SHA-OUT Pass phrase', 'pronamic_ideal' ),
			'type'     => 'password',
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'SHA-OUT pass phrase as mentioned in the payment provider dashboard: Configuration &raquo; Technical information &raquo; Transaction feedback.', 'pronamic_ideal' ),
			'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Hash algorithm
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ogone',
			'meta_key' => '_pronamic_gateway_ogone_hash_algorithm',
			'title'    => __( 'Hash algorithm', 'pronamic_ideal' ),
			'type'     => 'optgroup',
			'tooltip'  => 'Hash algorithm as mentioned in the payment provider dashboard: Configuration &raquo; Technical information',
			'options'  => array(
				Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_1   => __( 'SHA-1', 'pronamic_ideal' ),
				Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_256 => __( 'SHA-256', 'pronamic_ideal' ),
				Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_512 => __( 'SHA-512', 'pronamic_ideal' ),
			),
			'default'  => Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_1,
			'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// 3-D Secure
		$fields[] = array(
			'filter'      => FILTER_VALIDATE_BOOLEAN,
			'section'     => 'ogone',
			'meta_key'    => '_pronamic_gateway_ogone_3d_secure_enabled',
			'title'       => __( '3-D Secure', 'pronamic_ideal' ),
			'type'        => 'checkbox',
			'label'       => __( 'Enable 3-D Secure protocol', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_directlink' ),
		);

		// Transaction feedback fields
		$fields[] = array(
			'section'  => 'ogone',
			'title'    => __( 'Transaction feedback', 'pronamic_ideal' ),
			'type'     => 'description',
			'methods'   => array( 'ogone_orderstandard_easy' ),
			'html'     => sprintf(
				'<span class="dashicons dashicons-no"></span> %s',
				__( 'Payment status updates are not supported by this payment provider.', 'pronamic_ideal' )
			),
		);

		$fields[] = array(
			'section'       => 'ogone',
			'title'         => __( 'Transaction feedback', 'pronamic_ideal' ),
			'type'          => 'description',
			'methods'   => array( 'ogone_orderstandard', 'ogone_directlink' ),
			'html'          => sprintf(
				'<span class="dashicons dashicons-warning"></span> %s',
				__( 'Receiving payment status updates needs additional configuration, if not yet completed.', 'pronamic_ideal' )
			),
		);

		/*
		 * Advanced settings
		 */

		// Form Action URL
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_advanced',
			'meta_key'    => '_pronamic_gateway_ogone_form_action_url',
			'title'       => __( 'Form Action URL', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => __( 'With this setting you can override the default Ogone e-Commerce form action URL to the payment processing page.', 'pronamic_ideal' ),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard' ),
		);

		// Order ID
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_advanced',
			'meta_key'    => '_pronamic_gateway_ogone_order_id',
			'title'       => __( 'Order ID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => sprintf(
				__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'ORDERID' )
			),
			'description' => sprintf(
				'%s<br />%s',
				sprintf( __( 'Available tags: %s', 'pronamic_ideal' ), sprintf( '<code>%s</code> <code>%s</code>', '{order_id}', '{payment_id}' ) ),
				sprintf( __( 'Default: <code>%s</code>', 'pronamic_ideal' ), '{payment_id}' )
			),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Parameter Variable
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_advanced',
			'meta_key'    => '_pronamic_gateway_ogone_param_var',
			'title'       => __( 'Parameter Variable', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => sprintf(
				__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'PARAMVAR' )
			),
			'description' => sprintf(
				__( 'Available tags: %s', 'pronamic_ideal' ),
				sprintf( '<code>%s</code> <code>%s</code>', '{site_url}', '{home_url}' )
			),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Template Page
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ogone_advanced',
			'meta_key' => '_pronamic_gateway_ogone_template_page',
			'title'    => __( 'Template Page', 'pronamic_ideal' ),
			'type'     => 'text',
			'tooltip'  => sprintf(
				__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'TP' )
			),
			'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		/*
		 * Transaction feedback - Direct HTTP server-to-server request URLs
		 */

		// URL accepted, on hold or uncertain
		$fields[] = array(
			'section'     => 'ogone_feedback',
			'title'       => __( 'URL accepted, on hold or uncertain', 'pronamic_ideal' ),
			'type'        => 'text',
			'value'       => site_url( '/' ),
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => __( 'Direct HTTP server-to-server request URL for payment statuses accepted, on hold or uncertain".', 'pronamic_ideal' ),
			'readonly'    => true,
		);

		// URL cancel or deny
		$fields[] = array(
			'section'     => 'ogone_feedback',
			'title'       => __( 'URL cancel or deny', 'pronamic_ideal' ),
			'type'        => 'text',
			'value'       => site_url( '/' ),
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => __( 'Direct HTTP server-to-server request URL for payment statuses "cancelled by the client" or "too many rejections by the acquirer".', 'pronamic_ideal' ),
			'readonly'    => true,
		);

		// Return fields
		return $fields;
	}
}
