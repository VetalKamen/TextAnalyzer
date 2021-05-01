<?php

require_once 'Interfaces/Frequency.php';
require_once 'helper_functions.php';

class Text {
	private $text;

	public function __construct( $text ) {
		$this->text = trim( $text );
	}

	public function get_text(): string {
		return $this->text;
	}
}