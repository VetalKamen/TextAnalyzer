<?php

require_once dirname(dirname(__DIR__)) . '/Interfaces/Frequency.php';
require_once dirname(dirname(__DIR__)) . '/Interfaces/Counter.php';
require_once dirname(dirname(__DIR__)) . '/helper_functions.php';

class Char implements Frequency, Counter
{
    private $array_chars = [];
    private $chars_str;

    public function __construct( $text )
    {
        $this->array_chars = str_split($text->get_text());
        $this->chars_str   = implode($this->array_chars);
    }

    public function get_count(): int
    {
        return count($this->array_chars);
    }

    public function frequency(): string
    {
        $freq_of_chars = [];
        foreach ( count_chars($this->chars_str, 1) as $key => $value ) {
            $freq_of_chars[] = '[' . chr($key) . ']' . " matches : $value";
        }

        return implode('<br>', $freq_of_chars);
    }

    public function frequency_in_percentage(): string
    {
        $freq_of_chars  = [];
        $all_char_count = strlen($this->chars_str);
        foreach ( count_chars($this->chars_str, 1) as $key => $value ) {
            $percentage      = number_format(
                (float) ( $value / $all_char_count ) * 100,
                2,
                '.',
                '' 
            );
            $freq_of_chars[] = '[' . chr($key) . ']' . " : $percentage % from total";
        }

        return implode('<br>', $freq_of_chars);
    }
}
