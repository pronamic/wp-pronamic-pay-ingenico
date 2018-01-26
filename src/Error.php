<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico error
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @since 1.0.0
 */
class Error {
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
