<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico payment methods list (PMLIST parameter)
 * Description:
 * Copyright: 2005-2023 Pronamic
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
	private $data;

	/**
	 * Constructs and initialize a payment methods list
	 *
	 * @param array $data Data.
	 */
	public function __construct( array $data = [] ) {
		$this->data = $data;
	}

	/**
	 * Add payment method
	 *
	 * @param string $payment_method Payment method.
	 * @return void
	 */
	public function add_payment_method( $payment_method ) {
		$this->data[] = $payment_method;
	}

	/**
	 * Create a string representation of this payment methods list
	 *
	 * List of selected payment methods and/or card brands to show on the payment page. Separated by a semi-colon.
	 *
	 * @return string
	 */
	public function __toString() {
		return implode( ';', $this->data );
	}
}
