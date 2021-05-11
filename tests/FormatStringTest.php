<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';

class FormatStringTest extends TestCase {
	/**
	 * @dataProvider dataProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testFormatString( $input, $expected ) {
		$this->assertEquals( $expected, format_toString( $input ) );
	}

	public function dataProvider() {
		return [
			[
				[
					"dignissim",
					"tristique",
					"vehicula",
					"aliquam",
					"ligula",
					"libero",
					"Donec",
					"elit",
					"amet",
					"sit",
					"ut"
				],
				"dignissim<br>tristique<br>vehicula<br>aliquam<br>ligula<br>libero<br>Donec<br>elit<br>amet<br>sit<br>ut"
			]
		];
	}
}