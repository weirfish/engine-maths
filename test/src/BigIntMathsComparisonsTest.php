<?php

namespace Engine\Test\Maths;

class BigIntMathsComparisonsTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider comparatorDataProvider
	 */
	public function testComparator(\Engine\Maths\BigInt $a, \Engine\Maths\BigInt $b, int $expected)
	{
		$result = \Engine\Maths\BigIntMaths::compare($a, $b);

		$this->assertEquals($expected, $result);
	}

	public function comparatorDataProvider()
	{
		return
		[
			[
				\Engine\Maths\BigInt::fromInt(100),
				\Engine\Maths\BigInt::fromInt(100),
				0,
			],
			[
				\Engine\Maths\BigInt::fromStringArray(["100","200"]),
				\Engine\Maths\BigInt::fromStringArray(["100","200"]),
				0,
			],
			[
				\Engine\Maths\BigInt::fromStringArray(["100","201"]),
				\Engine\Maths\BigInt::fromStringArray(["100","200"]),
				1,
			],
			[
				\Engine\Maths\BigInt::fromStringArray(["100","200"]),
				\Engine\Maths\BigInt::fromStringArray(["100","201"]),
				-1,
			],
			[
				\Engine\Maths\BigInt::fromStringArray(["101","200"]),
				\Engine\Maths\BigInt::fromStringArray(["100","200"]),
				1,
			],
			[
				\Engine\Maths\BigInt::fromStringArray(["100","200"]),
				\Engine\Maths\BigInt::fromStringArray(["101","200"]),
				-1,
			],
			[
				\Engine\Maths\BigInt::fromString("99999999999999999999999"),
				\Engine\Maths\BigInt::fromString("99999999999999999999999"),
				0,
			],
			[
				\Engine\Maths\BigInt::fromString("99999999999999999999999"),
				\Engine\Maths\BigInt::fromString("99999999999999999999998"),
				1,
			],
			[
				\Engine\Maths\BigInt::fromString("99999999999999999999998"),
				\Engine\Maths\BigInt::fromString("99999999999999999999999"),
				-1,
			],
		];
	}
}