<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

use Pronamic\WordPress\Pay\Gateways\Ingenico\Config as Ingenico_Config;

/**
 * Title: Ingenico OrderStandard config
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Config extends Ingenico_Config {
	/**
	 * Hash algorithm.
	 *
	 * To verify the data that is submitted to its system (in case of e-Commerce the hidden fields to the payment page),
	 * Ogone requires the secure data verification method SHA. For each order, your server generates a unique character
	 * string (=digest), hashed with the SHA algorithm of your choice: SHA-1, SHA-256 or SHA-512.
	 *
	 * @link https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
	 * @var string
	 */
	public $hash_algorithm;

	/**
	 * SHA-IN passphrase.
	 *
	 * @link https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/security-pre-payment-check
	 * @var string
	 */
	public $sha_in_pass_phrase;

	/**
	 * SHA-OUT passphrase.
	 *
	 * @link https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/transaction-feedback#SC_7_3
	 * @var string
	 */
	public $sha_out_pass_phrase;

	/**
	 * API user ID.
	 *
	 * @since 1.3.2
	 * @var string
	 */
	public $user_id;

	/**
	 * API user password.
	 *
	 * @since 1.3.2
	 * @var string
	 */
	public $password;
}
