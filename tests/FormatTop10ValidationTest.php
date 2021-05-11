<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';

class FormatTop10ValidationTest extends TestCase {
	/**
	 * @dataProvider dataProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testFormatTop10Validation( $input, $expected ) {
		$this->assertEquals( $expected, count( format_top_10_validation( $input ) ) );
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
				10
			],
			[
				[
					"elit",
					"amet",
					"sit",
					"ut"
				],
				4
			]
		];
	}
}