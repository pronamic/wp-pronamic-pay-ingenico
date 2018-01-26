<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Pay\Gateways\Ingenico\Data;

/**
 * Title: Ingenico DirectLink data helper
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @since 1.0.0
 */
class DataHelper {
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
	 * Set user id
	 *
	 * @param string $user_id
	 *
	 * @return DataHelper
	 */
	public function set_user_id( $user_id ) {
		$this->data->set_field( 'USERID', $user_id );

		return $this;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 *
	 * @return DataHelper
	 */
	public function set_password( $password ) {
		$this->data->set_field( 'PSWD', $password );

		return $this;
	}
}
