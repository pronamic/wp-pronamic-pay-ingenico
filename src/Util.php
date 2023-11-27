<?php

namespace Pronamic\WordPress\Pay\Gateways\Ingenico;

/**
 * Title: Ingenico utility
 * Description:
 * Copyright: 2005-2023 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Util {
	/**
	 * Get parameter variable
	 *
	 * @param string $param_var Parameter variable.
	 * @return string
	 */
	public static function get_param_var( $param_var ) {
		$replace_pairs = [
			'{site_url}' => \site_url(),
			'{home_url}' => \home_url(),
		];

		$param_var = \strtr( $param_var, $replace_pairs );

		return $param_var;
	}
}
