<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico gateway settings
 * Description:
 * Copyright: 2005-2024 Pronamic
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
	 * @return array<int, array<string, mixed>>
	 */
	public static function get_settings_fields() {
		$fields = [];

		/*
		 * General.
		 */
		$fields[] = [
			'section' => 'general',
			'type'    => 'html',
			'html'    => __( 'Account details are provided by the payment provider after registration. These settings need to match with the payment provider dashboard.', 'pronamic_ideal' ),
		];

		// PSPID.
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ogone_psp_id',
			'title'    => __( 'PSPID', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => [ 'code' ],
			'tooltip'  => __( 'PSPID as mentioned in the payment provider dashboard.', 'pronamic_ideal' ),
		];

		// API user ID.
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ogone_user_id',
			'title'    => __( 'API user ID', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'User ID of the API user in the payment provider dashboard: Configuration &raquo; Users', 'pronamic_ideal' ),
		];

		// API user password.
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ogone_password',
			'title'    => __( 'API user password', 'pronamic_ideal' ),
			'type'     => 'password',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'Password of the API user in the payment provider dashboard: Configuration &raquo; Users', 'pronamic_ideal' ),
		];

		// SHA-IN Pass phrase.
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ogone_sha_in_pass_phrase',
			'title'    => __( 'SHA-IN Pass phrase', 'pronamic_ideal' ),
			'type'     => 'password',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'SHA-IN pass phrase as mentioned in the payment provider dashboard: Configuration &raquo; Technical information &raquo; Data and origin verification.', 'pronamic_ideal' ),
		];

		// SHA-OUT Pass phrase.
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ogone_sha_out_pass_phrase',
			'title'    => __( 'SHA-OUT Pass phrase', 'pronamic_ideal' ),
			'type'     => 'password',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'SHA-OUT pass phrase as mentioned in the payment provider dashboard: Configuration &raquo; Technical information &raquo; Transaction feedback.', 'pronamic_ideal' ),
		];

		// Hash algorithm.
		$fields[] = [
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_ogone_hash_algorithm',
			'title'    => __( 'Hash algorithm', 'pronamic_ideal' ),
			'type'     => 'optgroup',
			'tooltip'  => 'Hash algorithm as mentioned in the payment provider dashboard: Configuration &raquo; Technical information',
			'options'  => [
				Ingenico::SHA_1   => __( 'SHA-1', 'pronamic_ideal' ),
				Ingenico::SHA_256 => __( 'SHA-256', 'pronamic_ideal' ),
				Ingenico::SHA_512 => __( 'SHA-512', 'pronamic_ideal' ),
			],
			'default'  => Ingenico::SHA_1,
		];

		/*
		 * Advanced settings
		 */
		$fields[] = [
			'section' => 'advanced',
			'type'    => 'html',
			'html'    => __( 'Optional settings for advanced usage only.', 'pronamic_ideal' ),
		];

		// Form Action URL.
		$fields[] = [
			'section'  => 'advanced',
			'meta_key' => '_pronamic_gateway_ogone_form_action_url',
			'title'    => __( 'Form Action URL', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'With this setting you can override the default Ingenico e-Commerce form action URL to the payment processing page.', 'pronamic_ideal' ),
		];

		// Order ID.
		$fields[] = [
			'section'     => 'advanced',
			'meta_key'    => '_pronamic_gateway_ogone_order_id',
			'title'       => __( 'Order ID', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => [ 'regular-text', 'code' ],
			'tooltip'     => sprintf(
				/* translators: %s: <code>PARAMETER</code> */
				__( 'The Ingenico %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'ORDERID' )
			),
			'description' => sprintf(
				'%s<br />%s',
				sprintf(
					/* translators: %s: <code>{tag}</code> */
					__( 'Available tags: %s', 'pronamic_ideal' ),
					sprintf( '<code>%s</code> <code>%s</code>', '{order_id}', '{payment_id}' )
				),
				sprintf(
					/* translators: %s: default code */
					__( 'Default: <code>%s</code>', 'pronamic_ideal' ),
					'{payment_id}'
				)
			),
		];

		// Parameter COMPLUS.
		$fields[] = [
			'section'     => 'advanced',
			'meta_key'    => '_pronamic_gateway_ogone_complus',
			'title'       => \__( 'Parameter `COMPLUS`', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => [ 'regular-text', 'code' ],
			'tooltip'     => \sprintf(
				/* translators: %s: <code>PARAMETER</code> */
				\__( 'The Ingenico %s parameter.', 'pronamic_ideal' ),
				\sprintf( '<code>%s</code>', 'COMPLUS' )
			),
			'description' => \sprintf(
				/* translators: %s: <code>{tag}</code> */
				\__( 'Available tags: %s', 'pronamic_ideal' ),
				\sprintf( '<code>%s</code> <code>%s</code>', '{order_id}', '{payment_id}' )
			),
		];

		// Parameter Variable.
		$fields[] = [
			'section'     => 'advanced',
			'meta_key'    => '_pronamic_gateway_ogone_param_var',
			'title'       => __( 'Parameter Variable', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => [ 'regular-text', 'code' ],
			'tooltip'     => sprintf(
				/* translators: %s: <code>PARAMETER</code> */
				__( 'The Ingenico %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'PARAMVAR' )
			),
			'description' => sprintf(
				/* translators: %s: <code>{tag}</code> */
				__( 'Available tags: %s', 'pronamic_ideal' ),
				sprintf( '<code>%s</code> <code>%s</code>', '{site_url}', '{home_url}' )
			),
		];

		// Alias.
		$fields[] = [
			'section'  => 'advanced',
			'meta_key' => '_pronamic_gateway_ogone_alias_enabled',
			'title'    => __( 'Alias', 'pronamic_ideal' ),
			'type'     => 'checkbox',
			'label'    => __( 'Enable alias registration', 'pronamic_ideal' ),
			'tooltip'  => __( 'Enable alias creation as reference for batch payments. Requires the Alias Manager option (`REQ1`) to be enabled for the Ingenico account.', 'pronamic_ideal' ),
		];

		// Alias usage.
		$fields[] = [
			'section'     => 'advanced',
			'meta_key'    => '_pronamic_gateway_ogone_alias_usage',
			'title'       => __( 'Alias Usage', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => [ 'regular-text', 'code' ],
			'tooltip'     => sprintf(
				/* translators: %s: <code>PARAMETER</code> */
				__( 'The Ingenico %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'ALIASUSAGE' )
			),
			'description' => __( 'Description on payment page of how aliases are used.', 'pronamic_ideal' ),
		];

		// Template Page.
		$fields[] = [
			'section'  => 'advanced',
			'meta_key' => '_pronamic_gateway_ogone_template_page',
			'title'    => __( 'Template Page', 'pronamic_ideal' ),
			'type'     => 'text',
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => sprintf(
				/* translators: %s: <code>PARAMETER</code> */
				__( 'The Ingenico %s parameter.', 'pronamic_ideal' ),
				sprintf( '<code>%s</code>', 'TP' )
			),
		];

		/*
		 * Transaction feedback - Direct HTTP server-to-server request URLs
		 */
		$fields[] = [
			'section' => 'feedback',
			'type'    => 'html',
			'html'    => __( 'The URLs below need to be copied to the payment provider dashboard to receive automatic transaction status updates.', 'pronamic_ideal' ),
		];

		// URL accepted, on hold or uncertain.
		$fields[] = [
			'section'  => 'feedback',
			'title'    => __( 'URL accepted, on hold or uncertain', 'pronamic_ideal' ),
			'type'     => 'text',
			'value'    => site_url( '/' ),
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'Direct HTTP server-to-server request URL for payment statuses accepted, on hold or uncertain".', 'pronamic_ideal' ),
			'readonly' => true,
		];

		// URL cancel or deny.
		$fields[] = [
			'section'  => 'feedback',
			'title'    => __( 'URL cancel or deny', 'pronamic_ideal' ),
			'type'     => 'text',
			'value'    => site_url( '/' ),
			'classes'  => [ 'regular-text', 'code' ],
			'tooltip'  => __( 'Direct HTTP server-to-server request URL for payment statuses "cancelled by the client" or "too many rejections by the acquirer".', 'pronamic_ideal' ),
			'readonly' => true,
		];

		// Return fields.
		return $fields;
	}
}
