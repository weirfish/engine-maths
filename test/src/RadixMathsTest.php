<?php

namespace Engine\Test\Maths;

abstract class RadixMathsTest extends \PHPUnit\Framework\TestCase
{
	public function getEqualPair($sameBase = true, $sameExp = true)
	{
		$a = new \Engine\Maths\RadixNumber
		(
			$this->getSignificand(),
			$this->getBase(),
			$this->getExponent()
		);
		
		$b = $sameBase ? clone $a : \Engine\Maths\RadixMaths::convertToBase($a, $this->getBase());
		$b = $sameExp  ? clone $b : \Engine\Maths\RadixMaths::convertToExponent($b, $this->getExponent());

		return [$a, $b];
	}

	public function getLessThanPair($sameBase = true, $sameExp = true)
	{
		[$a, $b] = $this->getEqualPair($sameBase, $sameExp);

		$b->setSignificand($b->getSignificand() - \Engine\Util\Random::number(10, 99));

		return [$a, $b];
	}

	public function getGreaterThanPair($sameBase = true, $sameExp = true)
	{
		[$a, $b] = $this->getEqualPair($sameBase, $sameExp);

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
		return \Engine\Util\Random::number(1, 5);
	}
}