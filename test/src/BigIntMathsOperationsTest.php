<?php

namespace Engine\Test\Maths;

use Engine\Maths\BigInt;

class BigIntMathsOperationsTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider addDataProvider
	 */
	public function testAdd(\Engine\Maths\BigInt $a, \Engine\Maths\BigInt $b, \Engine\Maths\BigInt $expected)
	{
		$result = \Engine\Maths\BigIntMaths::add($a, $b);

		$this->assertEquals($expected->getNumberString(), $result->getNumberString());

		$result = \Engine\Maths\BigIntMaths::addMany($a, $b);

		$this->assertEquals($expected->getNumberString(), $result->getNumberString());
	}

	public function addDataProvider()
	{
		return
		[
			[
				BigInt::fromString("100"),
				BigInt::fromString("200"),
				BigInt::fromString("300")
			],
			[
				BigInt::fromString("123"),
				BigInt::fromString("789"),
				BigInt::fromString("912")
			],
			[
				BigInt::fromInt(100),
				BigInt::fromInt(200),
				BigInt::fromInt(300)
			],
			[
				BigInt::fromInt(123),
				BigInt::fromInt(789),
				BigInt::fromInt(912)
			],
			[
				BigInt::fromString("111111111111111111111111111111111111111111111111111111111111111111111111111111111111111"),
				BigInt::fromString("555555555555555555555555555555555555555555555555555555555555555555555555555555555555555"),
				BigInt::fromString("666666666666666666666666666666666666666666666666666666666666666666666666666666666666666")
			],
			[
				BigInt::fromString("123456123456123456123456123456123456123456123456123456123456123456"),
				BigInt::fromString("654321654321654321654321654321654321654321654321654321654321654321"),
				BigInt::fromString("777777777777777777777777777777777777777777777777777777777777777777")
			],
		];
	}
}