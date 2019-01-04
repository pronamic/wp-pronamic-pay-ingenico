<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico payment methods (PM parameter)
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 * @see     https://github.com/wp-pay-gateways/ogone/wiki/Brands
 */
class PaymentMethods {
	/**
	 * Acceptgiro
	 *
	 * @var string
	 */
	const ACCEPTGIRO = 'Acceptgiro';

	/**
	 * Bank transfer
	 *
	 * @var string
	 */
	const BANK_TRANSFER = 'Bank transfer';

	/**
	 * Credit Card
	 *
	 * @var string
	 */
	const CREDIT_CARD = 'CreditCard';

	/**
	 * DirectEbanking
	 *
	 * @var string
	 */
	const DIRECT_EBANKING = 'DirectEbanking';

	/**
	 * DirectEbankingNL
	 *
	 * @var string
	 */
	const DIRECT_EBANKING_NL = 'DirectEbankingNL';

	/**
	 * Constant for the iDEAL payment method.
	 *
	 * @var string
	 */
	const IDEAL = 'iDEAL';

	/**
	 * Payment on Delivery
	 *
	 * @var string
	 */
	const PAYMENT_ON_DELIVERY = 'Payment on Delivery';

	/**
	 * PayPal
	 *
	 * @var string
	 */
	const PAYPAL = 'PAYPAL';

	/**
	 * Wallie
	 *
	 * @var string
	 */
	const WALLIE = 'Wallie';
}
