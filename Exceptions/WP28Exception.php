<?php

namespace WP28\REPLACE\Lib\Core\Exceptions;

use Exception;
use Throwable;
use WP28\REPLACE\Lib\Core\Helpers\Plugin;

class WP28Exception extends Exception {

	public function __construct( $message, $code = 0, Throwable $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}

	public function render() {
		echo sprintf(__(
			"<p>Não é possível habilitar o plugin <strong>%s</strong> no momento, pois os seguintes requisitos não estão atendidos:</p>",
			Plugin::getTextDomain()),
			Plugin::getName());
	}

}