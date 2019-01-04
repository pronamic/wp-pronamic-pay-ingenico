<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\DirectLink;

/**
 * Title: Ingenico DirectLink order response
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class OrderResponse {
	public $order_id;

	public $pay_id;

	public $nc_status;

	public $nc_error;

	public $nc_error_plus;

	public $acceptance;

	public $status;

	public $eci;

	public $amount;

	public $currency;

	public $pm;

	public $brand;

	/**
	 * Constructs and initializes an Ogone DirectLink order response
	 */
	public function __construct() {

	}
}
