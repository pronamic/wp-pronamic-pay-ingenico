<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Gateways\Ingenico\Parameters;

/**
 * Title: Ingenico data URL helper class
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class DataUrlHelper extends DataHelper {
	/**
	 * Set accept URL
	 *
	 * URL of the web page to show the customer when the payment is authorized.
	 *
	 * @param string $url
	 */
	public function set_accept_url( $url ) {
		return $this->set_field( Parameters::ACCEPT_URL, $url );
	}

	/**
	 * Set cancel URL
	 *
	 * URL of the web page to show the customer when he cancels the payment.
	 *
	 * @param string $url
	 */
	public function set_cancel_url( $url ) {
		return $this->set_field( Parameters::CANCEL_URL, $url );
	}

	/**
	 * Set exception URL
	 *
	 * URL of the web page to show the customer when the payment result is uncertain.
	 *
	 * @param string $url
	 */
	public function set_exception_url( $url ) {
		return $this->set_field( Parameters::EXCEPTION_URL, $url );
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
		return $this->set_field( Parameters::DECLINE_URL, $url );
	}

	/**
	 * Set home URL
	 *
	 * @param string $url
	 */
	public function set_home_url( $url ) {
		return $this->set_field( 'home', $url );
	}

	/**
	 * Set back URL
	 *
	 * @param string $url
	 */
	public function set_back_url( $url ) {
		return $this->set_field( 'backurl', $url );
	}
}
