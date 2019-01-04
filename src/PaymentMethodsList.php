<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico payment methods list (PMLIST parameter)
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class PaymentMethodsList {
	/**
	 * List
	 *
	 * @var array
	 */
	private $list;

	/**
	 * Constructs and initialize a payment methods list
	 */
	public function __construct( array $list = array() ) {
		$this->list = $list;
	}

	/**
	 * Add payment method
	 *
	 * @param string $payment_method
	 */
	public function add_payment_method( $payment_method ) {
		$this->list[] = $payment_method;
	}

	/**
	 * Create a string representation of this payment methods list
	 *
	 * List of selected payment methods and/or card brands to show on the payment page. Separated by a semi-colon.
	 *
	 * @return string
	 */
	public function __toString() {
		return implode( ';', $this->list );
	}
}
