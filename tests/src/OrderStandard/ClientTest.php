<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico\OrderStandard;

use Pronamic\WordPress\Pay\Gateways\Ingenico\DataGeneralHelper;

/**
 * Title: Ogone client class test
 * Description:
 * Copyright: 2005-2023 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.1.0
 */
class ClientTest extends \WP_UnitTestCase {
	/**
	 * Test signature in empty.
	 */
	public function test_signature_in_empty() {
		$client = new Client( '' );

		$signature_in = $client->get_signature_in();

		$this->assertEquals( 'DA39A3EE5E6B4B0D3255BFEF95601890AFD80709', $signature_in );
	}

	/**
	 * Test signature in from documentation.
	 */
	public function test_signature_in_from_documentation() {
		/* @link http://pronamic.nl/wp-content/uploads/2012/02/ABNAMRO_e-Com-BAS_EN.pdf #page 11 */
		$client = new Client( 'MyPSPID' );

		$client->set_pass_phrase_in( 'Mysecretsig1875!?' );

		// Data.
		$ogone_data = $client->get_data();

		// General.
		$ogone_data_general = new DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_amount( '1500' )
			->set_currency( 'EUR' )
			->set_language( 'en_US' )
			->set_order_id( '1234' );

		// Signature.
		$signature_in = $client->get_signature_in();

		$this->assertEquals( 'F4CC376CD7A834D997B91598FA747825A238BE0A', $signature_in );
	}

	/**
	 * Test signature out from documentation.
	 */
	public function test_signature_out_from_documentation() {
		/* @link http://pronamic.nl/wp-content/uploads/2012/02/ABNAMRO_e-Com-BAS_EN.pdf #page 16 */
		$data = [
			'ACCEPTANCE' => '1234',
			'AMOUNT'     => '15.00',
			'BRAND'      => 'VISA',
			'CARDNO'     => 'xxxxxxxxxxxx1111',
			'CURRENCY'   => 'EUR',
			'NCERROR'    => '0',
			'ORDERID'    => '12',
			'PAYID'      => '32100123',
			'PM'         => 'CreditCard',
			'STATUS'     => '9',
			'SHASIGN'    => '8DC2A769700CA4B3DF87FE8E3B6FD162D6F6A5FA',
		];

		$client = new Client( 'MyPSPID' );

		$client->set_pass_phrase_out( 'Mysecretsig1875!?' );

		$result = $client->verify_request( $data );

		$this->assertNotSame( false, $result );
	}
}
