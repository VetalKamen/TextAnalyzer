<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';
require_once dirname( __DIR__ ) . '/src/Models/TextComponents/Word.php';
require_once dirname( __DIR__ ) . '/src/Models/Text.php';

class WordTest extends TestCase {
	/**
	 * @dataProvider dataLongestProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testSortByLengthLongest( $input, $expected ) {
		$text = new Text( $input );
		$word = new Word( $text );
		$this->assertEquals( $expected, $word->sort_by_length( 'longest' ) );
	}

	public function dataLongestProvider() {
		return [
			[
				'Admiration we surrounded possession frequently he. Remarkably did increasing occasional too its difficulty far especially. Known tiled but sorry joy balls',
				"Admiration<br>difficulty<br>surrounded<br>possession<br>frequently<br>Remarkably<br>increasing<br>occasional<br>especially<br>sorry"
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
		$text = new Text( $input );
		$word = new Word( $text );
		$this->assertEquals( $expected, $word->sort_by_length( 'shortest' ) );
	}

	public function dataShortestProvider() {
		return [
			[
				'Admiration we surrounded possession frequently he. Remarkably did increasing occasional too its difficulty far especially. Known tiled but sorry joy balls',
				"he<br>we<br>too<br>joy<br>but<br>did<br>its<br>far<br>balls<br>Known"
			],
		];
	}

	/**
	 * @dataProvider dataMostUsedProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testMostUsedWords( $input, $expected ) {
		$text = new Text( $input );
		$word = new Word( $text );
		$this->assertEquals( $expected, $word->most_used() );
	}

	public function dataMostUsedProvider() {
		return [
			[
				'Known tiled but sorry joy balls.',
				'"known"used 1 times<br>"tiled"used 1 times<br>"but"used 1 times<br>"sorry"used 1 times<br>"joy"used 1 times<br>"balls"used 1 times'
			],
		];
	}
}