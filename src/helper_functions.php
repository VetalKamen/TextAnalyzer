<?php

/**
 * Safe for UTF-8 encoding.
 *
 * @param string $text     some text.
 * @param string $encoding text encoding.
 *
 * @return string of imploded text.
 */
function mb_strrev( string $text, string $encoding = null ): string
{
    $chars = mb_str_split($text, 1, $encoding ?: mb_internal_encoding());

    return implode('', array_reverse($chars));
}

/**
 * Converting the output to string.
 *
 * @param array $value
 *
 * @return string of imploded text.
 */
function format_toString( $value )
{
    return implode('<br>', $value);
}

/**
 * Validation before outputting the top 10.
 * If number of values < 10, then return all values.
 *
 * @param array $values
 *
 * @return array of top 10 values.
 */
function format_top_10_validation( $values )
{
    if (count($values) >= 10 ) {
        return array_slice($values, 0, 10);
    }

    return array_slice($values, 0, count($values));
}

/**
 * Simple average calculation.
 *
 * @param int $sum
 * @param int $count
 *
 * @return string result in string format.
 */
function average( $sum, $count )
{
    return number_format((float) $sum / $count, 2, '.', '');
}

/**
 * Reversing default text with proper dots.
 *
 * @param string $text
 *
 * @return string imploded text.
 */
function reverse_default( $text )
{
    $words = explode(' ', $text);

    $reversed = array_reverse($words);
    foreach ( $reversed as $index => $value ) {

        if ($value[ - 1 ] === '.' ) {
            $reversed[ $index ] = '.' . substr($value, 0, - 1);
        }
    }

    return implode(' ', $reversed);
}

/**
 * Generating hash with sha1 algorithm for the text.
 *
 * @param string $text
 *
 * @return string generated hash.
 */
function generate_hash( $text )
{
    return sha1((string) $text);
}
