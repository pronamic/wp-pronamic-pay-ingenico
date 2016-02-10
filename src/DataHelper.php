<?php

/**
 * Title: Ogone data helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 */
abstract class Pronamic_WP_Pay_Gateways_Ogone_DataHelper {
	/**
	 * Data
	 *
	 * @var array
	 */
	protected $data;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a Ogone data default helper class
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_Ogone_Data $data ) {
		$this->data = $data;
	}

	//////////////////////////////////////////////////

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
