<?php
require_once dirname( __DIR__ ) . '/config.php';

class ReportController {
	private $pdo;

	public function __construct( $pdo ) {
		$this->pdo = $pdo;
	}

	public function all_reports() {
		$stmt = $this->pdo->prepare( 'SELECT * FROM reports;' );
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function all_reports_for_timeframe( $from, $to ) {
		$stmt = $this->pdo->prepare( 'SELECT * FROM reports as r WHERE r.created_at >= :from_date AND r.created_at < :to_date;' );
		$stmt->execute(
			[
				'from_date' => $from,
				'to_date'   => $to,
			] );

		return $stmt->fetchAll();
	}

	public function save_report( $report ) {
		$stmt = $this->pdo->prepare(
			'INSERT INTO reports VALUES(NULL,:session_id,:num_chars,:num_words,:num_sentences,:num_palindromes,:freq_chars,' .
			':percentage_chars,:avg_word_length,:avg_num_of_words_in_sentence,:top_10_mu_words,:top_10_longest_words,:top_10_shortest_words,' .
			':top_10_longest_sentences,:top_10_shortest_sentences,:top_10_longest_palindromes,:is_text_palindrome,:reversed_text,' .
			':reversed_with_order_intact,:hash_text, NOW());'
		);
		$stmt->execute(
			[
				'session_id'                   => $report['session_id'],
				'num_chars'                    => $report['num_chars'],
				'num_words'                    => $report['num_words'],
				'num_sentences'                => $report['num_sentences'],
				'num_palindromes'              => $report['num_palindromes'],
				'freq_chars'                   => $report['freq_chars'],
				'percentage_chars'             => $report['percentage_chars'],
				'avg_word_length'              => $report['avg_word_length'],
				'avg_num_of_words_in_sentence' => $report['avg_num_of_words_in_sentence'],
				'top_10_mu_words'              => $report['top_10_mu_words'],
				'top_10_longest_words'         => $report['top_10_longest_words'],
				'top_10_shortest_words'        => $report['top_10_shortest_words'],
				'top_10_longest_sentences'     => $report['top_10_longest_sentences'],
				'top_10_shortest_sentences'    => $report['top_10_shortest_sentences'],
				'top_10_longest_palindromes'   => $report['top_10_longest_palindromes'],
				'is_text_palindrome'           => $report['is_text_palindrome'],
				'reversed_text'                => $report['reversed_text'],
				'reversed_with_order_intact'   => $report['reversed_with_order_intact'],
				'hash_text'                    => $report['hash_text']
			] );

		return $stmt->fetchAll();
	}

	public function is_analyzed( $hash ) {
		$stmt = $this->pdo->prepare( 'SELECT hash_text FROM reports;' );
		$stmt->execute();

		$results = $stmt->fetchAll();
		foreach ( $results as $result ) {
			if ( in_array( $hash, $result ) ) {

				return true;
			}
		}

		return false;
	}

	public function get_report_by_hash( $hash ) {
		$stmt = $this->pdo->prepare( 'SELECT * FROM reports as r WHERE r.hash_text=:hash;' );
		$stmt->execute(
			[
				'hash' => $hash,
			] );

		return $stmt->fetch();
	}
}

$reportController = new ReportController( $pdo );