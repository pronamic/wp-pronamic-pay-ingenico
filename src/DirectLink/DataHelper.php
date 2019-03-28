<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

use Pronamic\WordPress\Pay\Gateways\Ingenico\Data;

/**
 * Title: Ingenico DirectLink data helper
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class DataHelper {
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
	 * Set user id
	 *
	 * @param string $user_id User ID.
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
	 * @param string $password Password.
	 *
	 * @return DataHelper
	 */
	public function set_password( $password ) {
		$this->data->set_field( 'PSWD', $password );

		return $this;
	}
}
