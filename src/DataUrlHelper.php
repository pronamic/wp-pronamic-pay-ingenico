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
	 * Set accept URL
	 *
	 * URL of the web page to show the customer when the payment is authorized.
	 *
	 * @param string $url
	 */
	public function set_accept_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ACCEPT_URL, $url );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set cancel URL
	 *
	 * URL of the web page to show the customer when he cancels the payment.
	 *
	 * @param string $url
	 */
	public function set_cancel_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CANCEL_URL, $url );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set exception URL
	 *
	 * URL of the web page to show the customer when the payment result is uncertain.
	 *
	 * @param string $url
	 */
	public function set_exception_url( $url ) {
		$this->data->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EXCEPTION_URL, $url );

		return $this;
	}

	//////////////////////////////////////////////////

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

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set home URL
	 *
	 * @param string $url
	 */
	public function set_home_url( $url ) {
		$this->data->set_field( 'home', $url );

		return $this;
	}

	/**
	 * Set back URL
	 *
	 * @param string $url
	 */
	public function set_back_url( $url ) {
		$this->data->set_field( 'backurl', $url );

		return $this;
	}
}
