<?php

namespace Engine\Test\Maths;

abstract class RadixMathsTest extends \PHPUnit\Framework\TestCase
{
	public function getEqualPair($same_base = true, $same_exp = true)
	{
		$a = new \Engine\Maths\RadixNumber
		(
			$this->getSignificand(),
			$this->getBase(),
			$this->getExponent()
		);
		
		$b = $same_base ? clone $a : \Engine\Maths\RadixMaths::convertToBase($a, $this->getBase());
		$b = $same_exp  ? clone $b : \Engine\Maths\RadixMaths::convertToExponent($b, $this->getExponent());

		return [$a, $b];
	}

	public function getLessThanPair($same_base = true, $same_exp = true)
	{
		[$a, $b] = $this->getEqualPair($same_base, $same_exp);

		$b->setSignificand($b->getSignificand() - \Engine\Util\Random::number(10, 99));

		return [$a, $b];
	}

	public function getGreaterThanPair($same_base = true, $same_exp = true)
	{
		[$a, $b] = $this->getEqualPair($same_base, $same_exp);

		$b->setSignificand($b->getSignificand() + \Engine\Util\Random::number(10, 99));

		return [$a, $b];
	}

	private function getSignificand()
	{
		return \Engine\Util\Random::number(100, 999) / 100 * \Engine\Util\Random::choice([1, -1]);
	}

	private function getBase()
	{
		return \Engine\Util\Random::number(2, 20);
	}

	private function getExponent()
	{
		return \Engine\Util\Random::number(1, 20);
	}
}