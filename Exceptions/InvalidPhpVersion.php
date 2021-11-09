<?php

namespace WP28\REPLACE\Lib\Core\Exceptions;


class InvalidPhpVersion extends WP28Exception {

	public function __construct( $message = "" ) {
		parent::__construct( $message );
	}

	public function render() {
		parent::render();
		echo $this->getMessage();
	}
}