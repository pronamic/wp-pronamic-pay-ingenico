<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since  1.0.0
 */
class Ingenico {
	/**
	 * Expiration date format
	 *
	 * @var string
	 */
	const EXPIRATION_DATE_FORMAT = 'm/y';

	/**
	 * Indicator for hash algorithm SHA-512
	 *
	 * @var string
	 */
	const SHA_512 = 'sha512';

	/**
	 * Indicator for hash algorithm SHA-256
	 *
	 * @var string
	 */
	const SHA_256 = 'sha256';

	/**
	 * Indicator for hash algorithm SHA-1
	 *
	 * @var string
	 */
	const SHA_1 = 'sha1';
}
