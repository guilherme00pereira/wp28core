<?php

namespace WP28\REPLACE\Lib\Core\Exceptions;

class WP28ExceptionFactory {

	public static function getException( string $plugin ): WP28Exception {
		switch ( $plugin ) {
			case "woocommerce/woocommerce.php":
				return new WooCommerceNotActiveException();
			default:
				return new WP28Exception();
		}
	}
}