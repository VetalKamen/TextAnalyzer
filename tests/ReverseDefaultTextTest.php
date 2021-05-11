<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';

class ReverseDefaultTextTest extends TestCase {
	/**
	 * @dataProvider dataProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testReverseDefaultTextWithCharactersIntact( $input, $expected ) {
		$this->assertEquals( $expected, reverse_default( $input ) );
	}

	public function dataProvider() {
		return [
			[
				'Quisque in interdum leo.',
				'.leo interdum in Quisque'
			],
			[
				'erat. Sed tincidunt dui quis',
				'quis dui tincidunt Sed .erat'
			]
		];
	}
}