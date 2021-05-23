<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';
require_once dirname( __DIR__ ) . '/src/Models/TextComponents/Sentence.php';
require_once dirname( __DIR__ ) . '/src/Models/Text.php';

class SentenceTest extends TestCase {
	/**
	 * @dataProvider dataLongestProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testSortByLengthLongest( $input, $expected ) {
		$text     = new Text( $input );
		$sentence = new Sentence( $text );
		$this->assertEquals( $expected, $sentence->sort_by_length( 'longest' ) );
	}

	public function dataLongestProvider() {
		return [
			[
				'Over fact all son tell this any his. No insisted confined of weddings to returned to debating rendered. Keeps order fully so do party means young. Table nay him jokes quick. In felicity up to graceful mistaken horrible consider. Abode never think to at.',
				" No insisted confined of weddings to returned to debating rendered<br> In felicity up to graceful mistaken horrible consider<br> Keeps order fully so do party means young<br>Over fact all son tell this any his<br> Table nay him jokes quick<br> Abode never think to at<br>"
			],
		];
	}

	/**
	 * @dataProvider dataShortestProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testSortByLengthShortest( $input, $expected ) {
		$text     = new Text( $input );
		$sentence = new Sentence( $text );
		$this->assertEquals( $expected, $sentence->sort_by_length( 'shortest' ) );
	}

	public function dataShortestProvider() {
		return [
			[
				'Over fact all son tell this any his. No insisted confined of weddings to returned to debating rendered. Keeps order fully so do party means young. Table nay him jokes quick. In felicity up to graceful mistaken horrible consider. Abode never think to at.',
				"<br> Abode never think to at<br> Table nay him jokes quick<br>Over fact all son tell this any his<br> Keeps order fully so do party means young<br> In felicity up to graceful mistaken horrible consider<br> No insisted confined of weddings to returned to debating rendered"
			],
		];
	}
}