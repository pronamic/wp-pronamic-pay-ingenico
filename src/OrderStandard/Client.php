<?php

/**
 * Title: Ogone order standard client
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0
 */
class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client {
	/**
	 * The payment server URL
	 *
	 * @var string
	 */
	private $payment_server_url;

	//////////////////////////////////////////////////

	/**
	 * The amount
	 *
	 * @var int
	 */
	private $amount;

	//////////////////////////////////////////////////

	/**
	 * Signature parameters IN
	 *
	 * @var array
	 */
	private $calculations_parameters_in;

	/**
	 * Signature parameters OUT
	 *
	 * @var array
	 */
	private $calculations_parameters_out;

	//////////////////////////////////////////////////

	/**
	 * Pass phrase IN
	 *
	 * @var string
	 */
	public $passPhraseIn;

	//////////////////////////////////////////////////

	/**
	 * Fields
	 *
	 * @var array
	 */
	private $fields;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize a iDEAL kassa object
	 */
	public function __construct() {
		$this->fields = array();

		$this->hash_algorithm = Pronamic_WP_Pay_Gateways_Ogone_HashAlgorithms::SHA_1;
	}

	//////////////////////////////////////////////////

	/**
	 * Get the payment server URL
	 *
	 * @return the payment server URL
	 */
	public function get_payment_server_url() {
		return $this->payment_server_url;
	}

	/**
	 * Set the payment server URL
	 *
	 * @param string $url an URL
	 */
	public function set_payment_server_url( $url ) {
		$this->payment_server_url = $url;
	}

	//////////////////////////////////////////////////

	/**
	 * Get hash algorithm
	 *
	 * @return string
	 */
	public function get_hash_algorithm() {
		return $this->hash_algorithm;
	}

	/**
	 * Set hash algorithm
	 *
	 * @param string $hashAlgorithm
	 */
	public function set_hash_algorithm( $hash_algorithm ) {
		$this->hash_algorithm = $hash_algorithm;
	}

	//////////////////////////////////////////////////

	/**
	 * Get password phrase IN
	 *
	 * @return string
	 */
	public function getPassPhraseIn() {
		return $this->passPhraseIn;
	}

	/**
	 * Set password phrase IN
	 *
	 * @param string $passPhraseIn
	 */
	public function setPassPhraseIn( $passPhraseIn ) {
		$this->passPhraseIn = $passPhraseIn;
	}

	//////////////////////////////////////////////////

	/**
	 * Get password phrase OUT
	 *
	 * @return string
	 */
	public function getPassPhraseOut() {
		return $this->passPhraseOut;
	}

	/**
	 * Set password phrase OUT
	 *
	 * @param string $passPhraseOut
	 */
	public function setPassPhraseOut( $passPhraseOut ) {
		$this->passPhraseOut = $passPhraseOut;
	}

	//////////////////////////////////////////////////
	// Fields
	//////////////////////////////////////////////////

	/**
	 * Get all the fields
	 *
	 * @return array
	 */
	public function get_fields() {
		return $this->fields;
	}

	/**
	 * Get field by the specifiek name
	 *
	 * @param string $name
	 */
	public function get_field( $name ) {
		$value = null;

		if ( isset( $this->fields[ $name ] ) ) {
			$value = $this->fields[ $name ];
		}

		return $value;
	}

	/**
	 * Set field
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function set_field( $name, $value ) {
		$this->fields[ $name ] = $value;
	}

	public function set_fields( array $fields ) {
		$this->fields = $fields;
	}

	//////////////////////////////////////////////////
	// Fields helper functinos
	//////////////////////////////////////////////////

	/**
	 * Get the PSP id
	 *
	 * @return an PSP id
	 */
	public function getPspId() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::PSPID );
	}

	/**
	 * Set the PSP id
	 *
	 * Your affiliation name in our system, chosen by yourself when opening your account
	 * with us. This is a unique identifier and can’t ever be changed.
	 *
	 * @param string PSP id
	 */
	public function setPspId( $psp_id ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::PSPID, $psp_id );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the order id
	 *
	 * @return an order id
	 */
	public function get_order_id() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID );
	}

	/**
	 * Set the order id
	 *
	 * @param string $orderId
	 */
	public function set_order_id( $order_id ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID, $order_id );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the language
	 *
	 * @return an language
	 */
	public function get_language() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::LANGUAGE );
	}

	/**
	 * Set the language
	 *
	 * The format is "language_Country".
	 * The language value is based on ISO 639-1.
	 * The country value is based on ISO 3166-1.
	 *
	 * @param string $language
	 */
	public function set_language( $language ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::LANGUAGE, $language );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the currency
	 *
	 * @return string
	 */
	public function getCurrency() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CURRENCY );
	}

	/**
	 * Set the currency
	 *
	 * Currency of the amount in alphabetic ISO code as can be found on
	 * http://www.currency-iso.org/iso_index/iso_tables/iso_tables_a1.htm
	 *
	 * @return string $currency
	 */
	public function set_currency( $currency ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CURRENCY, $currency );
	}

	//////////////////////////////////////////////////

	/**
	 * Get the amount
	 *
	 * @return float
	 */
	public function get_amount() {
		return $this->amount;
	}

	/**
	 * Set the amount
	 *
	 * @param float $amount
	 */
	public function set_amount( $amount ) {
		$this->amount = $amount;

		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::AMOUNT, Pronamic_WP_Pay_Util::amount_to_cents( $amount ) );
	}

	//////////////////////////////////////////////////

	/**
	 * Get customer name
	 *
	 * @return string
	 */
	public function getCustomerName() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CUSTOMER_NAME );
	}

	/**
	 * Set customer name
	 *
	 * Special characters are allowed, but quotes must be avoided. Most acquirers don’t check the
	 * customer name since names can be written in different ways.
	 *
	 * @param string $customerName
	 */
	public function set_customer_name( $customer_name ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CUSTOMER_NAME, $customer_name );
	}

	//////////////////////////////////////////////////

	/**
	 * Get e-mailaddress
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EMAIL );
	}

	/**
	 * Set e-mailaddress
	 *
	 * @param string $eMailAddress
	 */
	public function set_email( $email ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EMAIL, $email );
	}

	//////////////////////////////////////////////////

	/**
	 * Get owner addresss
	 *
	 * @return string
	 */
	public function getOwnerAddress() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::OWNER_ADDRESS );
	}

	/**
	 * Set owner address
	 *
	 * @param string $ownerAddress
	 */
	public function setOwnerAddress( $address ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::OWNER_ADDRESS, $address );
	}

	//////////////////////////////////////////////////

	/**
	 * Get owner country
	 *
	 * @return string
	 */
	public function getOwnerCountry() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::OWNER_COUNTRY );
	}

	/**
	 * Set owner country
	 *
	 * Country in ISO 3166-1-alpha-2 code as can be found on http://www.iso.org/iso/country_codes/iso_3166_code_lists.htm
	 *
	 * @param string $ownerCountry
	 */
	public function setOwnerCountry( $country ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::OWNER_COUNTRY, $country );
	}

	//////////////////////////////////////////////////

	/**
	 * Get owner ZIP
	 *
	 * @return string
	 */
	public function getOwnerZip() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::OWNER_ZIP );
	}

	/**
	 * Set owner ZIP
	 *
	 * @param string $ownerZip
	 */
	public function setOwnerZip( $zip ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::OWNER_ZIP, $zip );
	}

	//////////////////////////////////////////////////

	/**
	 * Get order description
	 *
	 * The com field is sometimes transmitted to the acquirer (depending on the acquirer),
	 * in order to be shown on the account statements of the merchant or the customer.
	 *
	 * @return string
	 */
	public function getOrderDescription() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::COM );
	}

	/**
	 * Set order description
	 *
	 * The com field is sometimes transmitted to the acquirer (depending on the acquirer),
	 * in order to be shown on the account statements of the merchant or the customer.
	 *
	 * @param string $description
	 */
	public function set_order_description( $description ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::COM, $description );
	}

	//////////////////////////////////////////////////
	// URL's
	//////////////////////////////////////////////////

	/**
	 * Get accept URL
	 *
	 * URL of the web page to show the customer when the payment is authorized.
	 *
	 * @reutnr string
	 */
	public function getAcceptUrl() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ACCEPT_URL );
	}

	/**
	 * Set accept URL
	 *
	 * URL of the web page to show the customer when the payment is authorized.
	 *
	 * @param string $url
	 */
	public function set_accept_url( $url ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::ACCEPT_URL, $url );
	}

	//////////////////////////////////////////////////

	/**
	 * Get cancel URL
	 *
	 * URL of the web page to show the customer when he cancels the payment.
	 *
	 * @return string
	 */
	public function get_cancel_url() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CANCEL_URL );
	}

	/**
	 * Set cancel URL
	 *
	 * URL of the web page to show the customer when he cancels the payment.
	 *
	 * @param string $url
	 */
	public function set_cancel_url( $url ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::CANCEL_URL, $url );
	}

	//////////////////////////////////////////////////

	/**
	 * Get exception URL
	 *
	 * URL of the web page to show the customer when the payment result is uncertain.
	 *
	 * @return string
	 */
	public function getExceptionUrl() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EXCEPTION_URL );
	}

	/**
	 * Set exception URL
	 *
	 * URL of the web page to show the customer when the payment result is uncertain.
	 *
	 * @param string $url
	 */
	public function set_exception_url( $url ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::EXCEPTION_URL, $url );
	}

	//////////////////////////////////////////////////

	/**
	 * Get decline URL
	 *
	 * URL of the web page to show the customer when the acquirer rejects the authorisation more
	 * than the maximum of authorised tries (10 by default, but can be changed in the technical
	 * information page).
	 *
	 * @return string
	 */
	public function getDeclineUrl() {
		return $this->get_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::DECLINE_URL );
	}

	/**
	 * Set decline URL
	 *
	 * URL of the web page to show the customer when the acquirer rejects the authorisation more
	 * than the maximum of authorised tries (10 by default, but can be changed in the technical
	 * information page).
	 *
	 * @param string $url
	 */
	public function set_decline_url( $url ) {
		$this->set_field( Pronamic_WP_Pay_Gateways_Ogone_Parameters::DECLINE_URL, $url );
	}

	//////////////////////////////////////////////////
	// Signature functions
	//////////////////////////////////////////////////

	/**
	 * Get signature IN
	 *
	 * @return string
	 */
	public function getSignatureIn() {
		$calculation_fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculations_parameters_in();

		$fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculation_fields( $calculation_fields, $this->fields );

		return Pronamic_WP_Pay_Gateways_Ogone_Security::get_signature( $fields, $this->getPassPhraseIn(), $this->hash_algorithm );
	}

	/**
	 * Get signature OUT
	 *
	 * @param array $fields
	 */
	public function getSignatureOut( $fields ) {
		$calculation_fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculations_parameters_out();

		$fields = Pronamic_WP_Pay_Gateways_Ogone_Security::get_calculation_fields( $calculation_fields, $fields );

		return Pronamic_WP_Pay_Gateways_Ogone_Security::get_signature( $fields, $this->getPassPhraseOut(), $this->hash_algorithm );
	}

	//////////////////////////////////////////////////

	/**
	 * Get HTML fields
	 *
	 * @return string
	 */
	public function getHtmlFields() {
		return Pronamic_IDeal_IDeal::htmlHiddenFields( array(
			// general parameters
			'PSPID'        => $this->getPspId(),
			'orderID'      => $this->get_order_id(),
			'amount'       => Pronamic_WP_Pay_Util::amount_to_cents( $this->get_amount() ),
			'currency'     => $this->getCurrency(),
			'language'     => $this->get_language(),

			'CN'           => $this->getCustomerName(),
			'EMAIL'        => $this->get_email(),

			'owneraddress' => $this->getOwnerAddress(),
			'ownerZIP'     => $this->getOwnerZip(),
			'ownertown'    => '',
			'ownercty'     => $this->getOwnerCountry(),
			'ownertelno'   => '',

			'COM'          => $this->getOrderDescription(),

			// check before the payment: see Security: Check before the Payment
			'SHASign'      => $this->getSignatureIn(),

			// layout information: see Look and Feel of the Payment Page
			// ?

			// post payment redirection: see Transaction Feedback to the Customer
			'accepturl'    => $this->getAcceptUrl(),
			'declineurl'   => $this->getDeclineUrl(),
			'exceptionurl' => $this->getExceptionUrl(),
			'cancelurl'    => $this->get_cancel_url(),
		) );
	}

	//////////////////////////////////////////////////

	/**
	 * Verify request
	 */
	public function verifyRequest( $data ) {
		$result = false;

		$data = array_change_key_case( $data, CASE_UPPER );

		if ( isset( $data['SHASIGN'] ) ) {
			$signature = $data['SHASIGN'];

			$signature_out = $this->getSignatureOut( $data );

			if ( strcasecmp( $signature, $signature_out ) === 0 ) {
				$result = filter_var_array( $data, array(
					Pronamic_WP_Pay_Gateways_Ogone_Parameters::ORDERID  => FILTER_SANITIZE_STRING,
					Pronamic_WP_Pay_Gateways_Ogone_Parameters::AMOUNT   => FILTER_VALIDATE_FLOAT,
					Pronamic_WP_Pay_Gateways_Ogone_Parameters::CURRENCY => FILTER_SANITIZE_STRING,
					'PM'         => FILTER_SANITIZE_STRING,
					'ACCEPTANCE' => FILTER_SANITIZE_STRING,
					'STATUS'     => FILTER_VALIDATE_INT,
					'CARDNO'     => FILTER_SANITIZE_STRING,
					'PAYID'      => FILTER_VALIDATE_INT,
					'NCERROR'    => FILTER_SANITIZE_STRING,
					'BRAND'      => FILTER_SANITIZE_STRING,
					'SHASIGN'    => FILTER_SANITIZE_STRING,
				) );
			}
		}

		return $result;
	}
}
