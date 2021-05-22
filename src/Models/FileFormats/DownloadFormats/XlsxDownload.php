<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Interfaces/ExportFile.php';
require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/vendor/autoload.php';

class XlsxDownload implements ExportFile
{
    private $report;

    public function __construct( $report )
    {
        $this->report = $report;
    }

    public function export()
    {
        $xlsx = SimpleXLSXGen::fromArray(
            [
            [ 'session_id', $this->report['session_id'] ],
            [ 'number_chars', $this->report['num_chars'] ],
            [ 'number_words', $this->report['num_words'] ],
            [ 'number_sentences', $this->report['num_sentences'] ],
            [ 'freq_chars', $this->report['freq_chars'] ],
            [ 'percentage_chars', $this->report['percentage_chars'] ],
            [ 'avg_word_length', $this->report['avg_word_length'] ],
            [ 'avg_num_of_words_in_sentence', $this->report['avg_num_of_words_in_sentence'] ],
            [ 'top_10_mu_words', $this->report['top_10_mu_words'] ],
            [ 'top_10_longest_words', $this->report['top_10_longest_words'] ],
            [ 'top_10_shortest_words', $this->report['top_10_shortest_words'] ],
            [ 'top_10_longest_sentences', $this->report['top_10_longest_sentences'] ],
            [ 'top_10_shortest_sentences', $this->report['top_10_shortest_sentences'] ],
            [ 'number_palindromes', $this->report['num_palindromes'] ],
            [ 'top_10_longest_palindromes', $this->report['top_10_longest_palindromes'] ],
            [ 'is_text_palindrome', $this->report['is_text_palindrome'] ],
            [ 'reversed_text', $this->report['reversed_text'] ],
            [ 'reversed_text_with_order_intact', $this->report['reversed_with_order_intact'] ],
            [ 'hash', $this->report['hash'] ]
            ]
        );
        $xlsx->downloadAs('result.xlsx');
        exit();
    }
}
