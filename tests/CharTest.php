<?php

use PHPUnit\Framework\TestCase;

require_once dirname( __DIR__ ) . '/src/helper_functions.php';
require_once dirname( __DIR__ ) . '/src/Models/TextComponents/Char.php';
require_once dirname( __DIR__ ) . '/src/Models/Text.php';

class CharTest extends TestCase {
	/**
	 * @dataProvider dataFreqProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testFrequency( $input, $expected ) {
		$text = new Text( $input );
		$char = new Char( $text );
		$this->assertEquals( $expected, $char->frequency() );
	}

	public function dataFreqProvider() {
		return [
			[
				'awdwad awd ',
				"[ ] matches : 1<br>[a] matches : 3<br>[d] matches : 3<br>[w] matches : 3"
			]
		];
	}

	/**
	 * @dataProvider dataFreqPercentageProvider
	 *
	 * @param $input
	 * @param $expected
	 */
	public function testFrequencyPercentage( $input, $expected ) {
		$text = new Text( $input );
		$char = new Char( $text );
		$this->assertEquals( $expected, $char->frequency_in_percentage() );
	}

	public function dataFreqPercentageProvider() {
		return [
			[
				'awdwad awd ',
				"[ ] : 10.00 % from total<br>[a] : 30.00 % from total<br>[d] : 30.00 % from total<br>[w] : 30.00 % from total"
			],
		];
	}
}