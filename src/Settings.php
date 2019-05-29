<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico gateway settings
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.2
 * @since   1.3.0
 */
class Settings {
	/**
	 * Fields.
	 *
	 * @param array $fields Settings fields.
	 *
	 * @return array
	 */
	public static function get_settings_fields( $type ) {
		$fields = array();

		/*
		 * General.
		 */
		$fields[] = array(
			'section' => 'general',
			'type'    => 'html',
			'html'    => __( 'Account details are provided by the payment provider after registration. These settings need to match with the payment provider dashboard.', 'pronamic_ideal' ),
		);

		// PSPID.
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'ogone',
			'meta_key' => '_pronamic_gateway_ogone_psp_id',
			'title'    => __( 'PSPID', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => array( 'code' ),
			'tooltip'  => __( 'PSPID as mentioned in the payment provider dashboard.', 'pronamic_ideal' ),
			'methods'  => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		if ( in_array( $type, array( 'standard', 'directlink' ), true ) ) {
			// API user ID.
			$fields[] = array(
				'filter'   => FILTER_SANITIZE_STRING,
				'section'  => 'ogone',
				'meta_key' => '_pronamic_gateway_ogone_user_id',
				'title'    => __( 'API user ID', 'pronamic_ideal' ),
				'type'     => 'text',
				'classes'  => array( 'regular-text', 'code' ),
				'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
				'tooltip'  => __( 'User ID of the API user in the payment provider dashboard: Configuration &raquo; Users', 'pronamic_ideal' ),
			);

			// API user password.
			$fields[] = array(
				'filter'   => FILTER_SANITIZE_STRING,
				'section'  => 'ogone',
				'meta_key' => '_pronamic_gateway_ogone_password',
				'title'    => __( 'API user password', 'pronamic_ideal' ),
				'type'     => 'password',
				'classes'  => array( 'regular-text', 'code' ),
				'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
				'tooltip'  => __( 'Password of the API user in the payment provider dashboard: Configuration &raquo; Users', 'pronamic_ideal' ),
			);
		}

		if ( 'standard' === $type ) {
			// SHA-IN Pass phrase.
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
		}

		if ( 'directlink' === $type ) {
			// SHA-IN Pass phrase.
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
		}

		if ( in_array( $type, array( 'standard', 'directlink' ), true ) ) {
			// SHA-OUT Pass phrase.
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

			// Hash algorithm.
			$fields[] = array(
				'filter'   => FILTER_SANITIZE_STRING,
				'section'  => 'ogone',
				'meta_key' => '_pronamic_gateway_ogone_hash_algorithm',
				'title'    => __( 'Hash algorithm', 'pronamic_ideal' ),
				'type'     => 'optgroup',
				'tooltip'  => 'Hash algorithm as mentioned in the payment provider dashboard: Configuration &raquo; Technical information',
				'options'  => array(
					Ingenico::SHA_1   => __( 'SHA-1', 'pronamic_ideal' ),
					Ingenico::SHA_256 => __( 'SHA-256', 'pronamic_ideal' ),
					Ingenico::SHA_512 => __( 'SHA-512', 'pronamic_ideal' ),
				),
				'default'  => Ingenico::SHA_1,
				'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
			);
		}

		if ( 'directlink' === $type ) {
			// 3-D Secure
			$fields[] = array(
				'filter'   => FILTER_VALIDATE_BOOLEAN,
				'section'  => 'ogone',
				'meta_key' => '_pronamic_gateway_ogone_3d_secure_enabled',
				'title'    => __( '3-D Secure', 'pronamic_ideal' ),
				'type'     => 'checkbox',
				'label'    => __( 'Enable 3-D Secure protocol', 'pronamic_ideal' ),
				'methods'  => array( 'ogone_directlink' ),
			);
		}

		if ( 'easy' === $type ) {
			// Transaction feedback fields.
			$fields[] = array(
				'section' => 'ogone',
				'title'   => __( 'Transaction feedback', 'pronamic_ideal' ),
				'type'    => 'description',
				'methods' => array( 'ogone_orderstandard_easy' ),
				'html'    => sprintf(
					'<span class="dashicons dashicons-no"></span> %s',
					__( 'Payment status updates are not supported by this payment provider.', 'pronamic_ideal' )
				),
			);
		}

		if ( in_array( $type, array( 'standard', 'directlink' ), true ) ) {
			$fields[] = array(
				'section'  => 'ogone',
				'title'    => __( 'Transaction feedback', 'pronamic_ideal' ),
				'type'     => 'description',
				'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
				'html'     => __( 'Receiving payment status updates needs additional configuration.', 'pronamic_ideal' ),
				'features' => array( 'webhook_manual_config' ),
			);
		}

		/*
		 * Advanced settings
		 */

		$fields[] = array(
			'section' => 'advanced',
			'type'    => 'html',
			'html'    => __( 'Optional settings for advanced usage only.', 'pronamic_ideal' ),
		);

		// Form Action URL.
		if ( in_array( $type, array( 'easy', 'standard' ), true ) ) {
			$fields[] = array(
				'filter'   => FILTER_SANITIZE_STRING,
				'section'  => 'ogone_advanced',
				'meta_key' => '_pronamic_gateway_ogone_form_action_url',
				'title'    => __( 'Form Action URL', 'pronamic_ideal' ),
				'type'     => 'text',
				'classes'  => array( 'regular-text', 'code' ),
				'tooltip'  => __( 'With this setting you can override the default Ogone e-Commerce form action URL to the payment processing page.', 'pronamic_ideal' ),
				'methods'  => array( 'ogone_orderstandard_easy', 'ogone_orderstandard' ),
			);
		}

		// Order ID.
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_advanced',
			'meta_key'    => '_pronamic_gateway_ogone_order_id',
			'title'       => __( 'Order ID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => sprintf(
				/* translators: %s: <code>ORDERID</code> */
				__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'ORDERID' )
			),
			'description' => sprintf(
				'%s<br />%s',
				sprintf(
					/* translators: %s: <code>{order_id}</code> <code>{payment_id}</code> */
					__( 'Available tags: %s', 'pronamic_ideal' ),
					sprintf( '<code>%s</code> <code>%s</code>', '{order_id}', '{payment_id}' )
				),
				sprintf(
					/* translators: %s: {payment_id} */
					__( 'Default: <code>%s</code>', 'pronamic_ideal' ),
					'{payment_id}'
				)
			),
			'methods'     => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
		);

		// Parameter Variable.
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'ogone_advanced',
			'meta_key'    => '_pronamic_gateway_ogone_param_var',
			'title'       => __( 'Parameter Variable', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'regular-text', 'code' ),
			'tooltip'     => sprintf(
				/* translators: %s: <code>PARAMVAR</code> */
				__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'PARAMVAR' )
			),
			'description' => sprintf(
				/* translators: %s: <code>{site_url}</code> <code>{home_url}</code> */
				__( 'Available tags: %s', 'pronamic_ideal' ),
				sprintf( '<code>%s</code> <code>%s</code>', '{site_url}', '{home_url}' )
			),
			'methods'     => array( 'ogone_orderstandard', 'ogone_directlink' ),
		);

		if ( in_array( $type, array( 'standard', 'directlink' ), true ) ) {
			// Alias.
			$fields[] = array(
				'filter'   => FILTER_VALIDATE_BOOLEAN,
				'section'  => 'ogone_advanced',
				'meta_key' => '_pronamic_gateway_ogone_alias_enabled',
				'title'    => __( 'Alias', 'pronamic_ideal' ),
				'type'     => 'checkbox',
				'label'    => __( 'Enable alias registration', 'pronamic_ideal' ),
				'tooltip'  => __( 'Enable alias creation as reference for batch payments. Requires the Alias Manager option (`REQ1`) to be enabled for the Ingenico account.', 'pronamic_ideal' ),
				'methods'  => array( 'ogone_directlink', 'ogone_orderstandard' ),
			);

			// Alias usage.
			$fields[] = array(
				'filter'      => FILTER_SANITIZE_STRING,
				'section'     => 'ogone_advanced',
				'meta_key'    => '_pronamic_gateway_ogone_alias_usage',
				'title'       => __( 'Alias Usage', 'pronamic_ideal' ),
				'type'        => 'text',
				'classes'     => array( 'regular-text', 'code' ),
				'tooltip'     => sprintf(
					/* translators: %s: <code>ALIASUSAGE</code> */
					__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
					sprintf( '<code>%s</code>', 'ALIASUSAGE' )
				),
				'description' => __( 'Description on payment page of how aliases are used.', 'pronamic_ideal' ),
				'methods'     => array( 'ogone_directlink', 'ogone_orderstandard' ),
			);

			// Template Page.
			$fields[] = array(
				'filter'   => FILTER_SANITIZE_STRING,
				'section'  => 'ogone_advanced',
				'meta_key' => '_pronamic_gateway_ogone_template_page',
				'title'    => __( 'Template Page', 'pronamic_ideal' ),
				'type'     => 'text',
				'classes'  => array( 'regular-text', 'code' ),
				'tooltip'  => sprintf(
					/* translators: %s: <code>TP</code> */
					__( 'The Ogone %s parameter.', 'pronamic_ideal' ),
					sprintf( '<code>%s</code>', 'TP' )
				),
				'methods'  => array( 'ogone_orderstandard', 'ogone_directlink' ),
			);
		}

		/*
		 * Transaction feedback - Direct HTTP server-to-server request URLs
		 */
		if ( in_array( $type, array( 'standard', 'directlink' ), true ) ) {
			$fields = array(
				'section' => 'feedback',
				'type'    => 'html',
				'html'    => __( 'The URLs below need to be copied to the payment provider dashboard to receive automatic transaction status updates.', 'pronamic_ideal' ),
			);
		}

		// URL accepted, on hold or uncertain.
		$fields[] = array(
			'section'  => 'ogone_feedback',
			'title'    => __( 'URL accepted, on hold or uncertain', 'pronamic_ideal' ),
			'type'     => 'text',
			'value'    => site_url( '/' ),
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'Direct HTTP server-to-server request URL for payment statuses accepted, on hold or uncertain".', 'pronamic_ideal' ),
			'readonly' => true,
		);

		// URL cancel or deny.
		$fields[] = array(
			'section'  => 'ogone_feedback',
			'title'    => __( 'URL cancel or deny', 'pronamic_ideal' ),
			'type'     => 'text',
			'value'    => site_url( '/' ),
			'classes'  => array( 'regular-text', 'code' ),
			'tooltip'  => __( 'Direct HTTP server-to-server request URL for payment statuses "cancelled by the client" or "too many rejections by the acquirer".', 'pronamic_ideal' ),
			'readonly' => true,
		);

		// Webhook status.
		$fields[] = array(
			'section'  => 'ogone_feedback',
			'methods'  => array( 'ogone_orderstandard_easy', 'ogone_orderstandard', 'ogone_directlink' ),
			'title'    => __( 'Status', 'pronamic_ideal' ),
			'type'     => 'description',
			'features' => array( 'webhook_manual_config' ),
			'callback' => array( $this, 'feedback_status' ),
		);

		// Return fields.
		return $fields;
	}
}
