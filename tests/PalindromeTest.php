<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';
require_once dirname( __DIR__ ) . '/src/Models/TextComponents/Palindrome.php';
require_once dirname( __DIR__ ) . '/src/Models/TextComponents/Word.php';
require_once dirname( __DIR__ ) . '/src/Models/Text.php';

class PalindromeTest extends TestCase {
	/**
	 * @dataProvider dataLongestProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testSortByLengthLongest( $input, $expected ) {
		$text       = new Text( $input );
		$word       = new Word( $text );
		$palindrome = new Palindrome( $word );
		$this->assertEquals( $expected, $palindrome->sort_by_length( 'longest' ) );
	}

	public function dataLongestProvider() {
		return [
			[
				'ASA, ATA, ATAATA. ATTA AUA, AVA, AWA. AYA AZA B. BAB BB BBB, BEEB. BIB, BOB, BOOB, BRB, BUB, C, CAAC',
				"ATAATA<br>CAAC<br>ATTA<br>BOOB<br>BEEB<br>BBB<br>BUB<br>BRB<br>BOB<br>BIB"
			],
		];
	}
}