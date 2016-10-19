<?php

/**
 * Title: Ogone config
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.2
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_Config extends Pronamic_WP_Pay_GatewayConfig {
	/**
	 * Ogone PSPID.
	 *
	 * The PSPID is the unique identifier of your Ogone account. It is the ID you chose (or were given) at the
	 * registration of your Ogone account, and which you usually login with.
	 *
	 * When configured in your shopping cart, our system will use the PSPID to identify you as a registered merchant.
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/user%20guides/shopping-carts/what-is-a-pspid
	 * @var string
	 */
	public $psp_id;

	/**
	 * The Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/link-your-website-to-the-payment-page#formaction
	 * @var string
	 */
	public $form_action_url;

	/**
	 * Constructs and initializes Ogone config object.
	 */
	public function __construct() {
		$this->set_form_action_url( $this->get_default_form_action_url() );
	}

	/**
	 * Get the default Ogone e-Commerce form action URL.
	 *
	 * @since 1.2.9
	 * @return string
	 */
	protected function get_default_form_action_url() {
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
	 * Get Direct Query URL.
	 *
	 * @since 1.3.2
	 * @return string
	 */
	public function get_direct_query_url() {
		if ( 'test' === $this->mode ) {
			return 'https://secure.ogone.com/ncol/test/querydirect.asp';
		}

		return 'https://secure.ogone.com/ncol/prod/querydirect.asp';
	}
}
