<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use Pronamic\WordPress\Pay\Core\Util;
use Pronamic\WordPress\Pay\Gateways\Ingenico\DataHelper;

/**
 * Title: Ingenico data default helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.0
 * @since 1.0.0
 */
class DataGeneralHelper extends DataHelper {
	/**
	 * Set PSP ID
	 *
	 * @param int $number
	 *
	 * @return DataGeneralHelper
	 */
	public function set_psp_id( $number ) {
		return $this->set_field( 'PSPID', $number );
	}

	/**
	 * Set order ID
	 *
	 * @param string $order_id
	 *
	 * @return DataGeneralHelper
	 */
	public function set_order_id( $order_id ) {
		return $this->set_field( 'ORDERID', $order_id );
	}

	/**
	 * Set order description
	 * AN..max32 (AN = Alphanumeric, free text)
	 *
	 * @param string $description
	 *
	 * @return DataGeneralHelper
	 */
	public function set_order_description( $description ) {
		return $this->set_field( 'COM', $description );
	}

	/**
	 * Set amount
	 *
	 * @param float $amount
	 *
	 * @return DataGeneralHelper
	 */
	public function set_amount( $amount ) {
		return $this->set_field( 'AMOUNT', Util::amount_to_cents( $amount ) );
	}

	/**
	 * Set currency
	 *
	 * @param string $currency
	 *
	 * @return DataGeneralHelper
	 */
	public function set_currency( $currency ) {
		return $this->set_field( 'CURRENCY', $currency );
	}

	/**
	 * Set customer name
	 *
	 * @deprecated since 1.3.0
	 *
	 * @param string $name
	 *
	 * @return DataGeneralHelper
	 */
	public function set_customer_name( $name ) {
		return $this->set_field( 'CN', $name );
	}

	/**
	 * Set email address
	 *
	 * @deprecated since 1.3.0
	 *
	 * @param string $email
	 *
	 * @return DataGeneralHelper
	 */
	public function set_email( $email ) {
		return $this->set_field( 'EMAIL', $email );
	}

	/**
	 * Set language
	 *
	 * @param string $language
	 *
	 * @return DataHelper
	 */
	public function set_language( $language ) {
		return $this->set_field( 'LANGUAGE', $language );
	}

	/**
	 * Set payment method
	 *
	 * @param string $payment_method
	 *
	 * @return DataHelper
	 */
	public function set_payment_method( $payment_method ) {
		return $this->set_field( 'PM', $payment_method );
	}

	/**
	 * Set payment methods list
	 *
	 * @param string $list
	 *
	 * @return DataHelper
	 */
	public function set_payment_methods_list( $list ) {
		return $this->set_field( 'PMLIST', $list );
	}

	/**
	 * Set brand of a credit/debit/purchasing card
	 *
	 * If you send the BRAND field without sending a value in the PM field (‘CreditCard’ or ‘Purchasing Card’),
	 * the BRAND value will not be taken into account.
	 *
	 * @param string $brand
	 *
	 * @return DataHelper
	 */
	public function set_brand( $brand ) {
		return $this->set_field( 'BRAND', $brand );
	}

	/**
	 * Set PARAMPLUS feedback parameters
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/transaction-feedback#feedbackparameters_variablefeedbackparameters
	 * @since 1.2.6
	 *
	 * @param string $paramplus
	 *
	 * @return DataHelper
	 */
	public function set_param_plus( $param_plus ) {
		return $this->set_field( 'PARAMPLUS', $param_plus );
	}
}
