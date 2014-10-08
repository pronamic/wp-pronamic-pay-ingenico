<?php

/**
 * Title: Ogone data URL helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.4.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DataUrlHelper {
	/**
	 * Data
	 *
	 * @var Pronamic_WP_Pay_Gateways_Ogone_Data
	 */
	private $data;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a Ogone data default helper class
	 *
	 * @param Pronamic_WP_Pay_Gateways_Ogone_Data $data
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_Ogone_Data $data ) {
		$this->data = $data;
	}

	//////////////////////////////////////////////////
	// Helper functions
	//////////////////////////////////////////////////

	/**
	 * Get accept URL
	 *
	 * URL of the web page to show the customer when the payment is authorized.
	 *
	 * @reutnr string
	 */
	public function get_accept_url() {
		return $this->data->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ACCEPT_URL );
	}

	/**
	 * Set accept URL
	 *
	 * URL of the web page to show the customer when the payment is authorized.
	 *
	 * @param string $url
	 */
	public function set_accept_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ACCEPT_URL, $url );
	}

	//////////////////////////////////////////////////

	/**
	 * Get cancel URL
	 *
	 * URL of the web page to show the customer when he cancels the payment.
	 *
	 * @return string
	 */
	public function get_cancel_url() {
		return $this->data->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CANCEL_URL );
	}

	/**
	 * Set cancel URL
	 *
	 * URL of the web page to show the customer when he cancels the payment.
	 *
	 * @param string $url
	 */
	public function set_cancel_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CANCEL_URL, $url );
	}

	//////////////////////////////////////////////////

	/**
	 * Get exception URL
	 *
	 * URL of the web page to show the customer when the payment result is uncertain.
	 *
	 * @return string
	 */
	public function get_exception_url() {
		return $this->data->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EXCEPTION_URL );
	}

	/**
	 * Set exception URL
	 *
	 * URL of the web page to show the customer when the payment result is uncertain.
	 *
	 * @param string $url
	 */
	public function set_exception_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EXCEPTION_URL, $url );
	}

	//////////////////////////////////////////////////

	/**
	 * Get decline URL
	 *
	 * URL of the web page to show the customer when the acquirer rejects the authorisation more
	 * than the maximum of authorised tries (10 by default, but can be changed in the technical
	 * information page).
	 *
	 * @return string
	 */
	public function get_decline_url() {
		return $this->data->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::DECLINE_URL );
	}

	/**
	 * Set decline URL
	 *
	 * URL of the web page to show the customer when the acquirer rejects the authorisation more
	 * than the maximum of authorised tries (10 by default, but can be changed in the technical
	 * information page).
	 *
	 * @param string $url
	 */
	public function set_decline_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::DECLINE_URL, $url );
	}
}
