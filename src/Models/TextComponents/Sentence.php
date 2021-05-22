<?php

require_once dirname(dirname(__DIR__)) . '/Interfaces/Sorter.php';
require_once dirname(dirname(__DIR__)) . '/Interfaces/Counter.php';
require_once dirname(dirname(__DIR__)) . '/helper_functions.php';

class Sentence implements Sorter, Counter
{
    private $array_sentences;

    public function __construct( $text )
    {
        $this->array_sentences = explode(".", $text->get_text());
    }

    public function sort_by_length( $length ): string
    {
        $values = $this->array_sentences;
        usort(
            $values, function ( $a, $b ) {
                return strlen($b) - strlen($a);
            }
        );

        if ($length == 'shortest' ) {
            $values = array_reverse($values, true);

            return format_toString(format_top_10_validation($values));
        }

        return format_toString(format_top_10_validation($values));
    }

    public function get_count(): int
    {
        return count($this->array_sentences);
    }
}
