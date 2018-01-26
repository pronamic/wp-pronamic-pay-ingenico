<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink\DataHelper;

/**
 * Title: Ingenico 3D Secure data helper
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @since 1.0.0
 */
class SecureDataHelper {
	/**
	 * Data
	 *
	 * @var array
	 */
	private $data;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a Ogone data default helper class
	 */
	public function __construct( Data $data ) {
		$this->data = $data;
	}

	//////////////////////////////////////////////////
	// Helper functions
	//////////////////////////////////////////////////

	/**
	 * Set 3-D Secure flag
	 *
	 * @param string $flag
	 *
	 * @return DataHelper
	 */
	public function set_3d_secure_flag( $flag ) {
		$this->data->set_field( 'FLAG3D', $flag ? 'Y' : 'N' );

		return $this;
	}

	/**
	 * Set HTTP Accept
	 *
	 * @param string $http_accept
	 *
	 * @return DataHelper
	 */
	public function set_http_accept( $http_accept ) {
		$this->data->set_field( 'HTTP_ACCEPT', $http_accept );

		return $this;
	}

	/**
	 * Set HTTP User-Agent
	 *
	 * @param string $user_agent
	 *
	 * @return DataHelper
	 */
	public function set_http_user_agent( $user_agent ) {
		$this->data->set_field( 'HTTP_USER_AGENT', $user_agent );

		return $this;
	}

	/**
	 * Set window
	 *
	 * @param string $window
	 *
	 * @return DataHelper
	 */
	public function set_window( $window ) {
		$this->data->set_field( 'WIN3DS', $window );

		return $this;
	}
}
