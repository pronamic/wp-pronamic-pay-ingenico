<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico data
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Data {
	/**
	 * Fields
	 *
	 * @var array
	 */
	private $fields;

	/**
	 * Constructs and initialize a iDEAL kassa object
	 */
	public function __construct() {
		$this->fields = array();
	}

	/**
	 * Get all the fields
	 *
	 * @return array
	 */
	public function get_fields() {
		return $this->fields;
	}

	/**
	 * Get field by the specifiek name
	 *
	 * @param string $name
	 */
	public function get_field( $name ) {
		$value = null;

		if ( isset( $this->fields[ $name ] ) ) {
			$value = $this->fields[ $name ];
		}

		return $value;
	}

	/**
	 * Set field
	 *
	 * @param string $name
	 * @param string $value
	 *
	 * @return Data
	 */
	public function set_field( $name, $value ) {
		$this->fields[ $name ] = $value;

		return $this;
	}
}
