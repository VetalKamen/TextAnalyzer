<?php

use PHPUnit\Framework\TestCase;
require_once dirname( __DIR__ ) . '/src/helper_functions.php';

class AverageTest extends TestCase {
	/**
	 * @dataProvider dataProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testAverage( $input, $expected ) {
		$this->assertEquals( $expected, average($input[0], $input[1]) );
	}

	public function dataProvider() {
		return [
			[ [ 20, 10 ], '2.00' ],
			[ [ 35, 7 ], '5.00' ]
		];
	}
}