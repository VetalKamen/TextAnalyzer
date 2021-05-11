<?php

require_once 'Text.php';
require_once 'TextComponents/Palindrome.php';
require_once 'TextComponents/Word.php';
require_once 'TextComponents/Char.php';
require_once 'TextComponents/Sentence.php';
require_once dirname( __DIR__ ) . '/helper_functions.php';
require_once dirname( __DIR__ ) . '/config.php';

class Report {
	public $data;

	public function __construct( $session_id, $text, $word, $char, $sentence, $palindrome, $hash ) {
		$this->data['report']['session_id']                   = $session_id;
		$this->data['report']['num_chars']                    = $char->get_count();
		$this->data['report']['num_words']                    = $word->get_count();
		$this->data['report']['num_sentences']                = $sentence->get_count();
		$this->data['report']['num_palindromes']              = $palindrome->get_count();
		$this->data['report']['freq_chars']                   = $char->frequency();
		$this->data['report']['percentage_chars']             = $char->frequency_in_percentage();
		$this->data['report']['avg_word_length']              = average( $this->data['report']['num_chars'],
			$this->data['report']['num_words'] );
		$this->data['report']['avg_num_of_words_in_sentence'] = average( $this->data['report']['num_words'],
			$this->data['report']['num_sentences'] );
		$this->data['report']['top_10_mu_words']              = $word->most_used();
		$this->data['report']['top_10_longest_words']         = $word->sort_by_length( 'longest' );
		$this->data['report']['top_10_shortest_words']        = $word->sort_by_length( 'shortest' );
		$this->data['report']['top_10_longest_sentences']     = $sentence->sort_by_length( 'longest' );
		$this->data['report']['top_10_shortest_sentences']    = $sentence->sort_by_length( 'shortest' );
		$this->data['report']['top_10_longest_palindromes']   = $palindrome->sort_by_length( 'longest' );
		$this->data['report']['is_text_palindrome']           = $palindrome->get_count() == $word->get_count() ? 'True' : 'False';
		$this->data['report']['reversed_text']                = mb_strrev( $text->get_text() );
		$this->data['report']['reversed_with_order_intact']   = reverse_default( $text->get_text() );
		$this->data['report']['hash_text']                    = $hash;
	}

}