<?php

/**
 * Title: Ogone error
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @since 1.0.0
*/
class Pronamic_WP_Pay_Gateways_Ogone_Error {
	/**
	 * Error code
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Error explanation
	 *
	 * @var string
	 */
	private $explanation;

	//////////////////////////////////////////////////

	/**
	 * Constructs and intializes an Ogone error
	 *
	 * @param string $code
	 * @param string $explanation
	 */
	public function __construct( $code, $explanation ) {
		$this->code        = $code;
		$this->explanation = $explanation;
	}

	//////////////////////////////////////////////////

	// @todo getters and setters

	//////////////////////////////////////////////////

	/**
	 * Create an string representation of this object
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->code . ' ' . $this->explanation;
	}
}
