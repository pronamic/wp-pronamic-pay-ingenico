<?php

/**
 * Title: Ogone OrderStandard config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.2.9
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Config extends Pronamic_WP_Pay_Gateways_Ogone_Config {
	/**
	 * Hash algorithm.
	 *
	 * To verify the data that is submitted to its system (in case of e-Commerce the hidden fields to the payment page), 
	 * Ogone requires the secure data verification method SHA. For each order, your server generates a unique character 
	 * string (=digest), hashed with the SHA algorithm of your choice: SHA-1, SHA-256 or SHA-512.
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
	 * @var string
	 */
	public $hash_algorithm;

	/**
	 * SHA-IN passphrase.
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
	 * @var string
	 */
	public $sha_in_pass_phrase;

	/**
	 * SHA-OUT passphrase.
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/transaction-feedback#SC_7_3
	 * @var string
	 */
	public $sha_out_pass_phrase;

	/**
	 * The Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/link-your-website-to-the-payment-page#formaction
	 * @var string
	 */
	public $form_action_url;

	/**
	 * Constructs and initialize a Ogone e-Commerce config object.
	 */
	public function __construct() {
		parent::__construct();

		$this->set_form_action_url( $this->get_default_form_action_url() );
	}

	/**
	 * Get the default Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @return string
	 */
	private function get_default_form_action_url() {
		$is_utf8 = strcasecmp( get_bloginfo( 'charset' ), 'UTF-8' ) === 0;

		if ( $is_utf8 ) {
			return 'https://secure.ogone.com/ncol/prod/orderstandard_utf8.asp';
		}

		return 'https://secure.ogone.com/ncol/prod/orderstandard.asp';
	}

	/**
	 * Get the Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @return string
	 */
	public function get_form_action_url() {
		return $this->form_action_url;
	}

	/**
	 * Set the Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @param string $url Ogone e-Commerce form action URL.
	 */
	public function set_form_action_url( $url ) {
		$this->form_action_url = $url;
	}

	/**
	 * Get Ogone payment server URL.
	 *
	 * @return string
	 * @deprecated deprecated since version 1.2.9, use get_form_action_url() instead.
	 */
	public function get_payment_server_url() {
		return $this->get_form_action_url();
	}

	/**
	 * Get gateway class.
	 *
	 * @return string
	 */
	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Gateway';
	}
}
