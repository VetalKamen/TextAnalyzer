<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/helper_functions.php';

class MultiByteStringReverseTest extends TestCase {
	/**
	 * @dataProvider dataProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testMultiByteStringReverse( $input, $expected ) {
		$this->assertEquals( $expected, mb_strrev( $input ) );
	}

	public function dataProvider() {
		return [
			[ 'Donec vel velit ex.', '.xe tilev lev cenoD' ],
			[ 'sed nunc a magna gravida vulputate vitae', 'eativ etatupluv adivarg angam a cnun des' ]
		];
	}
}