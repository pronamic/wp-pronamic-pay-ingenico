<?php

/**
 * Title: Ogone data default helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.4.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper {
	/**
	 * Data
	 *
	 * @var Pronamic_WP_Pay_Gateways_Ogone_Data
	 */
	private $data;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a Ogone data default helper class
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_Ogone_Data $data ) {
		$this->data = $data;
	}

	//////////////////////////////////////////////////
	// Helper functions
	//////////////////////////////////////////////////

	/**
	 * Set PSP ID
	 *
	 * @param int $number
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_psp_id( $number ) {
		$this->data->set_field( 'PSPID', $number );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set order ID
	 *
	 * @param string $order_id
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_order_id( $order_id ) {
		$this->data->set_field( 'ORDERID', $order_id );

		return $this;
	}

	/**
	 * Set order description
	 * AN..max32 (AN = Alphanumeric, free text)
	 *
	 * @param string $description
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_order_description( $description ) {
		$this->data->set_field( 'COM', $description );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set amount
	 *
	 * @param float $amount
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_amount( $amount ) {
		$this->data->set_field( 'AMOUNT', Pronamic_WP_Pay_Util::amount_to_cents( $amount ) );

		return $this;
	}

	/**
	 * Set currency
	 *
	 * @param string $currency
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_currency( $currency ) {
		$this->data->set_field( 'CURRENCY', $currency );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set customer name
	 *
	 * @param string $name
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_customer_name( $name ) {
		$this->data->set_field( 'CN', $name );

		return $this;
	}

	/**
	 * Set email address
	 *
	 * @param string $email
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper
	 */
	public function set_email( $email ) {
		$this->data->set_field( 'EMAIL', $email );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set language
	 *
	 * @param string $language
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_language( $language ) {
		$this->data->set_field( 'LANGUAGE', $language );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set payment method
	 *
	 * @param string $payment_method
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_payment_method( $payment_method ) {
		$this->data->set_field( 'PM', $payment_method );

		return $this;
	}

	//////////////////////////////////////////////////

	/**
	 * Set payment methods list
	 *
	 * @param string $list
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DirectLink_DataHelper
	 */
	public function set_payment_methods_list( $list ) {
		$this->data->set_field( 'PMLIST', $list );

		return $this;
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
		$this->data->set_field( 'BRAND', $brand );

		return $this;
	}
}
