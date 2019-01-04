<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico 3D Secure data helper
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class SecureDataHelper {
	/**
	 * Data
	 *
	 * @var array
	 */
	private $data;

	/**
	 * Constructs and initialize a Ogone data default helper class
	 *
	 * @param Data $data Data.
	 */
	public function __construct( Data $data ) {
		$this->data = $data;
	}

	/**
	 * Set 3-D Secure flag
	 *
	 * @param string $flag 3-D Secure flag.
	 *
	 * @return SecureDataHelper
	 */
	public function set_3d_secure_flag( $flag ) {
		$this->data->set_field( 'FLAG3D', $flag ? 'Y' : 'N' );

		return $this;
	}

	/**
	 * Set HTTP Accept
	 *
	 * @param string $http_accept HTTP accept.
	 *
	 * @return SecureDataHelper
	 */
	public function set_http_accept( $http_accept ) {
		$this->data->set_field( 'HTTP_ACCEPT', $http_accept );

		return $this;
	}

	/**
	 * Set HTTP User-Agent
	 *
	 * @param string $user_agent User agent.
	 *
	 * @return SecureDataHelper
	 */
	public function set_http_user_agent( $user_agent ) {
		$this->data->set_field( 'HTTP_USER_AGENT', $user_agent );

		return $this;
	}

	/**
	 * Set window
	 *
	 * @param string $window Window.
	 *
	 * @return SecureDataHelper
	 */
	public function set_window( $window ) {
		$this->data->set_field( 'WIN3DS', $window );

		return $this;
	}
}
