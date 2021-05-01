<?php

require_once dirname( __DIR__ ) . '/Interfaces/Sorter.php';
require_once dirname( __DIR__ ) . '/Interfaces/Counter.php';
require_once dirname( __DIR__ ) . '/Interfaces/UsageMeter.php';
require_once dirname( __DIR__ ) . '/helper_functions.php';

class Word implements Sorter, Counter, UsageMeter {
	private $array_words;
	private $text;

	public function __construct( $text ) {
		$this->text = $text;
		$this->array_words  = str_word_count( $text->get_text(), 1 );
	}

	public function get_array_words() {
		return $this->array_words;
	}

	public function sort_by_length( $length ): string {
		$values = $this->array_words;
		usort( $values, function ( $a, $b ) {
			return strlen( $b ) - strlen( $a );
		} );

		if ( $length == 'shortest' ) {
			$values = array_reverse( $values, true );

			return format_toString( format_top_10_validation( $values ) );
		}

		return format_toString( format_top_10_validation( $values ) );
	}

	public function get_count(): int {
		return count( $this->array_words );
	}

	public function most_used(): string {
		$most_used    = [];
		$default_text = strtolower( $this->text );
		$words        = str_word_count( $default_text, 1 );
		$words_count  = array_count_values( $words );
		arsort( $words_count );

		foreach ( $words_count as $key => $value ) {
			$most_used[] = '"' . $key . '"' . 'used ' . $value . ' times';
		}

		return format_toString( format_top_10_validation( $most_used ) );
	}
}