<?php

/**
 * Title: Ogone payment methods (PM parameter)
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 * @see https://github.com/wp-pay-gateways/ogone/wiki/Brands
 */
class Pronamic_WP_Pay_Gateways_Ogone_PaymentMethods {
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
