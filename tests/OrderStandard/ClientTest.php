<?php

class Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_ClientTest extends WP_UnitTestCase {
	function test_signature_in_empty() {
		$client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client( '' );

		$signature_in = $client->get_signature_in();

		$this->assertEquals( 'DA39A3EE5E6B4B0D3255BFEF95601890AFD80709', $signature_in );
	}

	function test_signature_in_from_documentation() {
		// http://pronamic.nl/wp-content/uploads/2012/02/ABNAMRO_e-Com-BAS_EN.pdf #page 11
		$client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client( 'MyPSPID' );

		$client->set_pass_phrase_in( 'Mysecretsig1875!?' );

		// Data
		$ogone_data = $client->get_data();

		// General
		$ogone_data_general = new Pronamic_WP_Pay_Gateways_Ogone_DataGeneralHelper( $ogone_data );

		$ogone_data_general
			->set_amount( 15 )
			->set_currency( 'EUR' )
			->set_language( 'en_US' )
			->set_order_id( '1234' );

		// Signature

		$signature_in = $client->get_signature_in();

		$this->assertEquals( 'F4CC376CD7A834D997B91598FA747825A238BE0A', $signature_in );
	}

	function test_signature_out_from_documentation() {
		// http://pronamic.nl/wp-content/uploads/2012/02/ABNAMRO_e-Com-BAS_EN.pdf #page 16
		$_GET = array(
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
		);

		$client = new Pronamic_WP_Pay_Gateways_Ogone_OrderStandard_Client( 'MyPSPID' );

		$client->set_pass_phrase_out( 'Mysecretsig1875!?' );

		$result = $client->verify_request( $_GET );

		$this->assertNotSame( false, $result );
	}
}
