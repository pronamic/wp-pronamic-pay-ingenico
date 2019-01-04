<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

use DateTime;

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
class DataCreditCardHelper extends DataHelper {
	/**
	 * Set credit card number.
	 *
	 * @param int $number Credit card number.
	 *
	 * @return DataCreditCardHelper
	 */
	public function set_number( $number ) {
		return $this->set_field( 'CARDNO', $number );
	}

	/**
	 * Set expiration date.
	 *
	 * @param DateTime $date Expiration date.
	 *
	 * @return DataCreditCardHelper
	 */
	public function set_expiration_date( DateTime $date ) {
		return $this->set_field( 'ED', $date->format( Ingenico::EXPIRATION_DATE_FORMAT ) );
	}

	/**
	 * Set security code.
	 *
	 * @param string $security_code Security code.
	 *
	 * @return DataCreditCardHelper
	 */
	public function set_security_code( $security_code ) {
		return $this->set_field( 'CVC', $security_code );
	}
}
