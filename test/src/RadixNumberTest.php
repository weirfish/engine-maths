<?php

namespace Engine\Test\Maths;

class RadixNumberTest extends \PhpUnit\Framework\TestCase
{
	public function test()
	{
		$significand = \Engine\Util\Random::number(1, 9);
		$base        = \Engine\Util\Random::number(1, 9);
		$exponent    = \Engine\Util\Random::number(1, 9);

		$number = \Engine\Maths\RadixNumber::create()
		->setSignificand($significand)
		->setBase($base)
		->setExponent($exponent);

		$this->assertEquals
		(
			$significand . "x" . $base . "^" . $exponent,
			(string)$number
		);
	}
}