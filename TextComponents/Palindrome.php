<?php

require_once dirname( __DIR__ ) . '\Interfaces\Sorter.php';
require_once dirname( __DIR__ ) . '/Interfaces/Counter.php';
require_once dirname( __DIR__ ) . '/helper_functions.php';

class Palindrome implements Sorter, Counter {
	private $palindromes = [];

	public function __construct( $words ) {
		foreach ( $words->get_array_words() as $word ) {
			if ( $word == mb_strrev( $word ) ) {
				$this->palindromes[] = $word;
			}
		}
	}

	public function sort_by_length( $length ): string {
		$values = $this->palindromes;
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
		return count( $this->palindromes );
	}
}
