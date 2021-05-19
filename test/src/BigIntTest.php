<?php

namespace Engine\Test\Maths;

class BigIntTest extends \PHPUnit\Framework\TestCase
{
	function testFromInt()
	{
		$value = \Engine\Util\Random::number(10000, 99999);

		$bigint = \Engine\Maths\BigInt::fromInt($value);

		$this->assertEquals($bigint->getNumberString(), (string)$value);
	}

	function testFromString()
	{
		$value = \Engine\Util\Random::numericString(5);
		$bigint = \Engine\Maths\BigInt::fromString($value);
		$this->assertEquals($bigint->getNumberString(), $value);

		$value = \Engine\Util\Random::numericString(50);
		$bigint = \Engine\Maths\BigInt::fromString($value);
		$this->assertEquals($bigint->getNumberString(), $value);
	}

	function testSimplify()
	{
		$bigint = \Engine\Maths\BigInt::fromStringArray(["100", "200", "300"])
		->simplify();

		$this->assertEquals($bigint->getNumbers(), ["100200300"]);

		$bigint = \Engine\Maths\BigInt::fromStringArray(["100", "200", "300", "400", "500", "600", "700"])
		->simplify();

		$this->assertEquals($bigint->getNumbers(), ["100200300400500600", "700"]);

		$bigint = \Engine\Maths\BigInt::fromStringArray(["1111", "2222", "3333", "4444", "5555", "6666", "7777"])
		->simplify();

		$this->assertEquals($bigint->getNumbers(), ["111122223333444455", "5566667777"]);
	}

	function testToRadix()
	{
		$start = \Engine\Maths\BigInt::fromString("111222333444555666");

		$radix = $start->toRadix();

		$this->assertEquals(10, $radix->getBase());
		$this->assertEquals(17, $radix->getExponent());
		$this->assertEquals(1.1122233344455566, $radix->getSignificand());
	}
}