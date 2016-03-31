<?php

/**
 * Title: Ogone data default helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.3.0
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper extends Pronamic_WP_Pay_Gateways_Ogone_DataHelper {
	/**
	 * Set PSP ID
	 *
	 * @param int $number
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_psp_id( $number ) {
		return $this->set_field( 'PSPID', $number );
	}

	//////////////////////////////////////////////////

	/**
	 * Set order ID
	 *
	 * @param string $order_id
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_order_id( $order_id ) {
		return $this->set_field( 'ORDERID', $order_id );
	}

	/**
	 * Set order description
	 * AN..max32 (AN = Alphanumeric, free text)
	 *
	 * @param string $description
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_order_description( $description ) {
		return $this->set_field( 'COM', $description );
	}

	//////////////////////////////////////////////////

	/**
	 * Set amount
	 *
	 * @param float $amount
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_amount( $amount ) {
		return $this->set_field( 'AMOUNT', Pronamic_WP_Pay_Util::amount_to_cents( $amount ) );
	}

	/**
	 * Set currency
	 *
	 * @param string $currency
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_currency( $currency ) {
		return $this->set_field( 'CURRENCY', $currency );
	}

	//////////////////////////////////////////////////

	/**
	 * Set customer name
	 *
	 * @deprecated since 1.3.0
	 * @param string $name
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_customer_name( $name ) {
		return $this->set_field( 'CN', $name );
	}

	/**
	 * Set email address
	 *
	 * @deprecated since 1.3.0
	 * @param string $email
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_email( $email ) {
		return $this->set_field( 'EMAIL', $email );
	}

	//////////////////////////////////////////////////

	/**
	 * Set language
	 *
	 * @param string $language
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_language( $language ) {
		return $this->set_field( 'LANGUAGE', $language );
	}

	//////////////////////////////////////////////////

	/**
	 * Set payment method
	 *
	 * @param string $payment_method
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_payment_method( $payment_method ) {
		return $this->set_field( 'PM', $payment_method );
	}

	//////////////////////////////////////////////////

	/**
	 * Set payment methods list
	 *
	 * @param string $list
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_payment_methods_list( $list ) {
		return $this->set_field( 'PMLIST', $list );
	}

	//////////////////////////////////////////////////

	/**
	 * Set brand of a credit/debit/purchasing card
	 *
	 * If you send the BRAND field without sending a value in the PM field (‘CreditCard’ or ‘Purchasing Card’),
	 * the BRAND value will not be taken into account.
	 *
	 * @param string $brand
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_brand( $brand ) {
		return $this->set_field( 'BRAND', $brand );
	}

	//////////////////////////////////////////////////

	/**
	 * Set PARAMPLUS feedback parameters
	 *
	 * @see https://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce/transaction-feedback#feedbackparameters_variablefeedbackparameters
	 * @since 1.2.6
	 * @param string $paramplus
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_param_plus( $param_plus ) {
		return $this->set_field( 'PARAMPLUS', $param_plus );
	}
}
