<?php

/**
 * Title: Ogone data default helper class
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.4.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_DataCreditCardHelper extends Pronamic_WP_Pay_Gateways_Ogone_DataHelper {
	/**
	 * Constructs and initialize a Ogone data default helper class
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_Ogone_Data $data ) {
		parent::__construct( $data );
	}

	//////////////////////////////////////////////////
	// Helper functions
	//////////////////////////////////////////////////

	/**
	 * Set credit card number
	 *
	 * @param int $number
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataCreditCardHelper
	 */
	public function set_number( $number ) {
		return $this->set_field( 'CARDNO', $number );
	}

	/**
	 * Set expiration date
	 *
	 * @param DateTime $date
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataCreditCardHelper
	 */
	public function set_expiration_date( DateTime $date ) {
		return $this->set_field( 'ED', $date->format( Pronamic_WP_Pay_Gateways_Ogone_Ogone::EXPIRATION_DATE_FORMAT ) );
	}

	/**
	 * Set security code
	 *
	 * @param string $security_code
	 * @return Pronamic_WP_Pay_Gateways_Ogone_DataCreditCardHelper
	 */
	public function set_security_code( $security_code ) {
		return $this->set_field( 'CVC', $security_code );
	}
}
