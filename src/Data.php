<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico data
 * Description:
 * Copyright: 2005-2024 Pronamic
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
	 * @var array<string, string>
	 */
	private $fields;

	/**
	 * Constructs and initialize a Data object
	 */
	public function __construct() {
		$this->fields = [];
	}

	/**
	 * Get all the fields
	 *
	 * @return array<string, string>
	 */
	public function get_fields() {
		return $this->fields;
	}

	/**
	 * Get field by the specified name
	 *
	 * @param string $name Field name.
	 * @return string|null
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
	 * @param string $name  Field name.
	 * @param string $value Field value.
	 *
	 * @return Data
	 */
	public function set_field( $name, $value ) {
		$this->fields[ $name ] = $value;

		return $this;
	}
}
