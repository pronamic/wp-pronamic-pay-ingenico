<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico data helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
abstract class DataHelper {
	/**
	 * Data
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Constructs and initialize a Ogone data default helper class
	 */
	public function __construct( Data $data ) {
		$this->data = $data;
	}

	/**
	 * Set field
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function set_field( $name, $value ) {
		$this->data->set_field( $name, $value );

		return $this;
	}
}
