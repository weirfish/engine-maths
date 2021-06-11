<?php

namespace Engine\Test\Maths;

class RadixMathsOperationsTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @dataProvider reduceDataProvider
	 */
	public function testReduce($startSignificand, $startBase, $startExponent, $expectedSignificand, $expectedExponent)
	{
		$start = \Engine\Maths\RadixNumber::create()
		->setSignificand($startSignificand)
		->setBase($startBase)
		->setExponent($startExponent);

		$actual = \Engine\Maths\RadixMaths::simplify($start);

		$this->assertEquals($start->getBase(), $actual->getBase());
		$this->assertEquals($expectedSignificand, $actual->getSignificand());
		$this->assertEquals($expectedExponent, $actual->getExponent());
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
		];
	}

	/**
	 * @dataProvider multiplyDataProvider
	 */
	public function testMultiply(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, \Engine\Maths\RadixNumber $exp)
	{
		$result = \Engine\Maths\RadixMaths::multiply($a, $b)->round();
		$exp    = $exp->round();

		$this->assertEquals($result->getSignificand(), $exp->getSignificand());
		$this->assertEquals($result->getBase(), $exp->getBase());
		$this->assertEquals($result->getExponent(), $exp->getExponent());
	}

	public function multiplyDataProvider()
	{
		return 
		[
			[
				new \Engine\Maths\RadixNumber(3, 10, 2),
				new \Engine\Maths\RadixNumber(2, 10, 2),
				new \Engine\Maths\RadixNumber(6, 10, 4),
			],
			[
				new \Engine\Maths\RadixNumber(1.25, 8, 2),
				new \Engine\Maths\RadixNumber(2.5, 8, 4),
				new \Engine\Maths\RadixNumber(3.125, 8, 6),
			],
			[
				new \Engine\Maths\RadixNumber(5, 10, 2),
				new \Engine\Maths\RadixNumber(2.5, 8, 3),
				new \Engine\Maths\RadixNumber(6.4, 10, 5),
			],
		];
	}

	/**
	 * @dataProvider divideDataProvider
	 */
	public function testDivide(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, \Engine\Maths\RadixNumber $exp)
	{
		$result = \Engine\Maths\RadixMaths::divide($a, $b)->round();
		$exp    = $exp->round();

		$this->assertEquals($result->getSignificand(), $exp->getSignificand());
		$this->assertEquals($result->getBase(), $exp->getBase());
		$this->assertEquals($result->getExponent(), $exp->getExponent());
	}

	public function divideDataProvider()
	{
		return 
		[
			[
				new \Engine\Maths\RadixNumber(6, 10, 4),
				new \Engine\Maths\RadixNumber(2, 10, 2),
				new \Engine\Maths\RadixNumber(3, 10, 2),
			],
			[
				new \Engine\Maths\RadixNumber(3.125, 8, 6),
				new \Engine\Maths\RadixNumber(2.5, 8, 4),
				new \Engine\Maths\RadixNumber(1.25, 8, 2),
			],
			[
				new \Engine\Maths\RadixNumber(6.4, 10, 5),
				new \Engine\Maths\RadixNumber(2.5, 8, 3),
				new \Engine\Maths\RadixNumber(5, 10, 2),
			],
		];
	}
}