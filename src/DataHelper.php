<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico data helper class
 * Description:
 * Copyright: 2005-2019 Pronamic
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
	 *
	 * @param Data $data Data.
	 */
	public function __construct( Data $data ) {
		$this->data = $data;
	}

	/**
	 * Set field
	 *
	 * @param string $name  Name.
	 * @param string $value Value.
	 *
	 * @return mixed
	 */
	public function set_field( $name, $value ) {
		$this->data->set_field( $name, $value );

		return $this;
	}
}
