<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico data default helper class
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class DataGeneralHelper extends DataHelper {
	/**
	 * Set alias.
	 *
	 * @param string $alias Alias.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_alias( $alias ) {
		return $this->set_field( 'ALIAS', $alias );
	}

	/**
	 * Set alias usage.
	 *
	 * @param string $alias_usage Alias usage.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_alias_usage( $alias_usage ) {
		return $this->set_field( 'ALIASUSAGE', $alias_usage );
	}

	/**
	 * Set PSP ID
	 *
	 * @param int $number PSP ID.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_psp_id( $number ) {
		return $this->set_field( 'PSPID', $number );
	}

	/**
	 * Set order ID
	 *
	 * @param string $order_id Order ID.
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
	 * @param string $description Description.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_order_description( $description ) {
		return $this->set_field( 'COM', $description );
	}

	/**
	 * Set amount
	 *
	 * @param float $amount Amount in cents.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_amount( $amount ) {
		return $this->set_field( 'AMOUNT', $amount );
	}

	/**
	 * Set currency
	 *
	 * @param string $currency Currency.
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
	 * @param string $name Customer name.
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
	 * @param string $email Email address.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_email( $email ) {
		return $this->set_field( 'EMAIL', $email );
	}

	/**
	 * Set language
	 *
	 * @param string $language Language.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_language( $language ) {
		return $this->set_field( 'LANGUAGE', $language );
	}

	/**
	 * Set payment method
	 *
	 * @param string $payment_method Payment method.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_payment_method( $payment_method ) {
		return $this->set_field( 'PM', $payment_method );
	}

	/**
	 * Set payment methods list
	 *
	 * @param string $list Payment method list.
	 *
	 * @return DataGeneralHelper
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
	 * @param string $brand Brand of card.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_brand( $brand ) {
		return $this->set_field( 'BRAND', $brand );
	}

	/**
	 * Set PARAMPLUS feedback parameters
	 *
	 * @link https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/transaction-feedback#feedbackparameters_variablefeedbackparameters
	 * @since 1.2.6
	 *
	 * @param string $param_plus `PARAMPLUS` parameter value.
	 *
	 * @return DataGeneralHelper
	 */
	public function set_param_plus( $param_plus ) {
		return $this->set_field( 'PARAMPLUS', $param_plus );
	}
}
