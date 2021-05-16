<?php

namespace Engine\Test\Maths;

class RadixMathsConversionTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider baseConversionDataProvider
	 */
	public function testBaseConversion(\Engine\Maths\RadixNumber $number, int $base, \Engine\Maths\RadixNumber $expected)
	{
		$converted = \Engine\Maths\RadixMaths::convertToBase($number, $base);

		$this->assertEquals($converted->getSignificand(), $expected->getSignificand());
		$this->assertEquals($converted->getBase(), $expected->getBase());
		$this->assertEquals($converted->getExponent(), $expected->getExponent());
	}

	public function baseConversionDataProvider()
	{
		return
		[
			[
				new \Engine\Maths\RadixNumber(1, 10, 2),
				8,
				new \Engine\Maths\RadixNumber(1.5625, 8, 2),
			],
			[
				new \Engine\Maths\RadixNumber(1.5625, 8, 2),
				10,
				new \Engine\Maths\RadixNumber(1, 10, 2),
			],
		];
	}
	/**
	 * @dataProvider exponentConversionDataProvider
	 */
	public function testExponentConversion(\Engine\Maths\RadixNumber $number, int $exp, \Engine\Maths\RadixNumber $expected)
	{
		$converted = \Engine\Maths\RadixMaths::convertToExponent($number, $exp);

		$this->assertEquals($converted->getSignificand(), $expected->getSignificand());
		$this->assertEquals($converted->getBase(), $expected->getBase());
		$this->assertEquals($converted->getExponent(), $expected->getExponent());
	}

	public function exponentConversionDataProvider()
	{
		return
		[
			[
				new \Engine\Maths\RadixNumber(1, 10, 2),
				1,
				new \Engine\Maths\RadixNumber(10, 10, 1),
			],
			[
				new \Engine\Maths\RadixNumber(1.5625, 8, 2),
				3,
				new \Engine\Maths\RadixNumber(1.5625 / 8, 8, 3),
			],
		];
	}
}