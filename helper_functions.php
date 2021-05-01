<?php

// safe for UTF-8 encoding
function mb_strrev( string $string, string $encoding = null ): string {
	$chars = mb_str_split( $string, 1, $encoding ?: mb_internal_encoding() );

	return implode( '', array_reverse( $chars ) );
}

// converting the output to string
function format_toString( $value ) {
	return implode( '<br>', $value );
}

// validation before outputting the top 10
function format_top_10_validation( $values ) {
	if ( count( $values ) >= 10 ) {
		return array_slice( $values, 0, 10 );
	}

	return array_slice( $values, 0, count( $values ) );
}

// simple average calculation
function average( $sum, $count ) {
	return number_format( (float) $sum / $count, 2, '.', '' );
}

// reversing default text with proper dots
function reverse_default( $text ) {
	$words = explode( ' ', $text );

	$reversed = array_reverse( $words );
	foreach ( $reversed as $index => $value ) {

		if ( $value[ - 1 ] === '.' ) {
			$reversed[ $index ] = '.' . substr( $value, 0, - 1 );
		}
	}

	return implode( ' ', $reversed );
}