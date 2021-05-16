<?php

namespace Engine\Test\Maths;

class RadixMathsOperationsTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider convertToBaseDataProvider
	 */
	function testConvertToBase($start_base, $start_exponent, $start_significant, $new_base, $expected_exponent, $expected_significand)
	{
		$start = \Engine\Maths\RadixNumber::create()
		->setBase($start_base)
		->setExponent($start_exponent)
		->setSignificand($start_significant);


		$actual = \Engine\Maths\RadixMaths::convertToBase($start, $new_base);

		$this->assertEquals(round($expected_exponent, 4), round($actual->getExponent(), 4));
		$this->assertEquals(round($new_base, 4), round($actual->getBase(), 4));
		$this->assertEquals(round($expected_significand, 4), round($actual->getSignificand(), 4));
	}

	public function convertToBaseDataProvider()
	{
		return
		[
			[2, 4, 1, 4, 2, 1],
			[10, 20, 4.2, 2, 68, 1.4230]
		];
	}

	/**
	 * @dataProvider reduceDataProvider
	 */
	public function testReduce($start_significand, $start_base, $start_exponent, $expected_significand, $expected_exponent)
	{
		$start = \Engine\Maths\RadixNumber::create()
		->setSignificand($start_significand)
		->setBase($start_base)
		->setExponent($start_exponent);

		$actual = \Engine\Maths\RadixMaths::simplify($start);

		$this->assertEquals($start->getBase(), $actual->getBase());
		$this->assertEquals($expected_significand, $actual->getSignificand());
		$this->assertEquals($expected_exponent, $actual->getExponent());
	}

	public function reduceDataProvider()
	{
		return
		[
			[100, 10, 2, 1, 4],
			[101, 10, 2, 1.01, 4]
		];
	}

	/**
	 * @dataProvider subtractDataProvider
	 */
	public function testSubtract(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, \Engine\Maths\RadixNumber $exp)
	{
		$result = \Engine\Maths\RadixMaths::subtract($a, $b)->round();
		$exp    = $exp->round();

		$this->assertEquals($result->getSignificand(), $exp->getSignificand());
		$this->assertEquals($result->getBase(), $exp->getBase());
		$this->assertEquals($result->getExponent(), $exp->getExponent());
	}

	public function subtractDataProvider()
	{
		$construtor = function()
		{
			$a = $this->makeRandomRadix();
			$b = $this->makeRandomRadix();

			$b_base_a = \Engine\Maths\RadixMaths::convertToBase($b, $a->getBase());
			$b_exp_a  = \Engine\Maths\RadixMaths::convertToExponent($b_base_a, $a->getExponent());

			return
			[
				$a,
				$b,
				\Engine\Maths\RadixMaths::simplify
				(
					\Engine\Maths\RadixNumber::create()
					->setBase($a->getBase())
					->setExponent($a->getExponent())
					->setSignificand($a->getSignificand() - $b_exp_a->getSignificand())
				)
			];
		};

		return 
		[
			[
				new \Engine\Maths\RadixNumber(3, 10, 2),
				new \Engine\Maths\RadixNumber(1, 10, 2),
				new \Engine\Maths\RadixNumber(2, 10, 2),
			],
			[
				new \Engine\Maths\RadixNumber(3.5, 10, 2),
				new \Engine\Maths\RadixNumber(1, 10, 2),
				new \Engine\Maths\RadixNumber(2.5, 10, 2),
			],
			[
				new \Engine\Maths\RadixNumber(2, 8, 3),
				new \Engine\Maths\RadixNumber(1.38, 10, 2),
				new \Engine\Maths\RadixNumber(1.7305, 8, 3),
			],
			[
				new \Engine\Maths\RadixNumber(1.25, 10, 2),
				new \Engine\Maths\RadixNumber(2, 8, 3),
				new \Engine\Maths\RadixNumber(-8.99, 10, 2),
			],
			$construtor(),
			$construtor(),
			$construtor(),
			$construtor(),
			$construtor(),
		];
	}

	/**
	 * @dataProvider addDataProvider
	 */
	public function testAdd(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, \Engine\Maths\RadixNumber $exp)
	{
		$result = \Engine\Maths\RadixMaths::add($a, $b)->round();
		$exp    = $exp->round();

		$this->assertEquals($result->getSignificand(), $exp->getSignificand());
		$this->assertEquals($result->getBase(), $exp->getBase());
		$this->assertEquals($result->getExponent(), $exp->getExponent());
	}

	public function addDataProvider()
	{
		$construtor = function()
		{
			$a = $this->makeRandomRadix();
			$b = $this->makeRandomRadix();

			$b_base_a = \Engine\Maths\RadixMaths::convertToBase($b, $a->getBase());
			$b_exp_a  = \Engine\Maths\RadixMaths::convertToExponent($b_base_a, $a->getExponent());

			return
			[
				$a,
				$b,
				\Engine\Maths\RadixMaths::simplify
				(
					\Engine\Maths\RadixNumber::create()
					->setBase($a->getBase())
					->setExponent($a->getExponent())
					->setSignificand($a->getSignificand() + $b_exp_a->getSignificand())
				)
			];
		};

		return 
		[
			[
				new \Engine\Maths\RadixNumber(1, 10, 2),
				new \Engine\Maths\RadixNumber(2, 10, 2),
				new \Engine\Maths\RadixNumber(3, 10, 2),
			],
			[
				new \Engine\Maths\RadixNumber(1, 10, 2),
				new \Engine\Maths\RadixNumber(2.5, 10, 2),
				new \Engine\Maths\RadixNumber(3.5, 10, 2),
			],
			[
				new \Engine\Maths\RadixNumber(1, 10, 2),
				new \Engine\Maths\RadixNumber(2.5, 8, 3),
				new \Engine\Maths\RadixNumber(1.38, 10, 3),
			],
			$construtor(),
			$construtor(),
			$construtor(),
			$construtor(),
			$construtor(),
		];
	}

	private function makeRandomRadix()
	{
		return \Engine\Maths\RadixNumber::create()
		->setSignificand(\Engine\Util\Random::number(100, 999) / 100)
		->setBase(\Engine\Util\Random::number(2, 20))
		->setExponent(\Engine\Util\Random::number(2, 20));
	}
}