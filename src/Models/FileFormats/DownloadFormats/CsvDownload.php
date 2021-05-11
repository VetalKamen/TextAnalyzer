<?php
require_once dirname( dirname( dirname( __DIR__ ) ) ) . '/Interfaces/ExportFile.php';

class CsvDownload implements ExportFile {
	private $report;

	public function __construct( $report ) {
		$this->report = $report;
	}

	public function export() {
		$output = fopen( "php://output", "wb" );
		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=result.csv' );
		fputcsv( $output,
			[
				'session_id',
				'number_chars',
				'number_words',
				'number_sentences',
				'freq_chars',
				'percentage_chars',
				'avg_word_length',
				'avg_num_of_words_in_sentence',
				'top_10_mu_words',
				'top_10_longest_words',
				'top_10_shortest_words',
				'top_10_longest_sentences',
				'top_10_shortest_sentences',
				'number_palindromes',
				'top_10_longest_palindromes',
				'is_text_palindrome',
				'reversed_text',
				'reversed_text_with_order_intact',
				'hash'
			]
		);

		if ( ! empty( $this->report ) ) {
			fputcsv( $output,
				[
					$this->report['session_id'],
					$this->report['num_chars'],
					$this->report['num_words'],
					$this->report['num_sentences'],
					$this->report['freq_chars'],
					$this->report['percentage_chars'],
					$this->report['avg_word_length'],
					$this->report['avg_num_of_words_in_sentence'],
					$this->report['top_10_mu_words'],
					$this->report['top_10_longest_words'],
					$this->report['top_10_shortest_words'],
					$this->report['top_10_longest_sentences'],
					$this->report['top_10_shortest_sentences'],
					$this->report['num_palindromes'],
					$this->report['top_10_longest_palindromes'],
					$this->report['is_text_palindrome'],
					$this->report['reversed_text'],
					$this->report['reversed_with_order_intact'],
					$this->report['hash']
				]
			);
		}
		fclose( $output );
		exit();
	}
}