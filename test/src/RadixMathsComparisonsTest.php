<?php

namespace Engine\Test\Maths;

class RadixMathsComparisonsTest extends RadixMathsTest
{
	/**
	 * @dataProvider equalsDataProvider
	 */
	public function testEquals(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, ?bool $passes)
	{
		if(null === $passes)
		{
			$this->assertNull($passes);
			return;
		}

		$this->assertEquals($passes, \Engine\Maths\RadixMaths::isEqual($a, $b));
	}
	/**
	 * @dataProvider lessThanDataProvider
	 */
	public function testLessThan(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, ?bool $passes)
	{
		if(null === $passes)
		{
			$this->assertNull($passes);
			return;
		}

		$this->assertEquals($passes, \Engine\Maths\RadixMaths::isLessThan($a, $b));
	}
	/**
	 * @dataProvider lessThanOrEqualDataProvider
	 */
	public function testLessThanOrEqual(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, ?bool $passes)
	{
		if(null === $passes)
		{
			$this->assertNull($passes);
			return;
		}

		$this->assertEquals($passes, \Engine\Maths\RadixMaths::isLessThanOrEqual($a, $b));
	}
	/**
	 * @dataProvider greaterThanDataProvider
	 */
	public function testGreaterThan(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, ?bool $passes)
	{
		if(null === $passes)
		{
			$this->assertNull($passes);
			return;
		}

		$this->assertEquals($passes, \Engine\Maths\RadixMaths::isGreaterThan($a, $b));
	}
	/**
	 * @dataProvider greaterThanOrEqualDataProvider
	 */
	public function testGreaterThanOrEqual(\Engine\Maths\RadixNumber $a, \Engine\Maths\RadixNumber $b, ?bool $passes)
	{
		if(null === $passes)
		{
			$this->assertNull($passes);
			return;
		}

		$this->assertEquals($passes, \Engine\Maths\RadixMaths::isGreaterThanOrEqual($a, $b));
	}

	public function greaterThanOrEqualDataProvider()
	{
		return
		[
			[...$this->getEqualPair(true, true), true],
			[...$this->getEqualPair(false, true), true],
			[...$this->getEqualPair(true, false), true],
			[...$this->getEqualPair(false, false), true],
			[...$this->getLessThanPair(true, true), false],
			[...$this->getLessThanPair(false, true), false],
			[...$this->getLessThanPair(true, false), false],
			[...$this->getLessThanPair(false, false), false],
			[...$this->getGreaterThanPair(true, true), true],
			[...$this->getGreaterThanPair(false, true), true],
			[...$this->getGreaterThanPair(true, false), true],
			[...$this->getGreaterThanPair(false, false), true],
		];
	}

	public function greaterThanDataProvider()
	{
		return
		[
			[...$this->getEqualPair(true, true), false],
			[...$this->getEqualPair(false, true), false],
			[...$this->getEqualPair(true, false), false],
			[...$this->getEqualPair(false, false), false],
			[...$this->getLessThanPair(true, true), false],
			[...$this->getLessThanPair(false, true), false],
			[...$this->getLessThanPair(true, false), false],
			[...$this->getLessThanPair(false, false), false],
			[...$this->getGreaterThanPair(true, true), true],
			[...$this->getGreaterThanPair(false, true), true],
			[...$this->getGreaterThanPair(true, false), true],
			[...$this->getGreaterThanPair(false, false), true],
		];
	}

	public function lessThanOrEqualDataProvider()
	{
		return
		[
			[...$this->getEqualPair(true, true), true],
			[...$this->getEqualPair(false, true), true],
			[...$this->getEqualPair(true, false), true],
			[...$this->getEqualPair(false, false), true],
			[...$this->getLessThanPair(true, true), true],
			[...$this->getLessThanPair(false, true), true],
			[...$this->getLessThanPair(true, false), true],
			[...$this->getLessThanPair(false, false), true],
			[...$this->getGreaterThanPair(true, true), false],
			[...$this->getGreaterThanPair(false, true), false],
			[...$this->getGreaterThanPair(true, false), false],
			[...$this->getGreaterThanPair(false, false), false],
		];
	}

	public function lessThanDataProvider()
	{
		return
		[
			[...$this->getEqualPair(true, true), false],
			[...$this->getEqualPair(false, true), false],
			[...$this->getEqualPair(true, false), false],
			[...$this->getEqualPair(false, false), false],
			[...$this->getLessThanPair(true, true), true],
			[...$this->getLessThanPair(false, true), true],
			[...$this->getLessThanPair(true, false), true],
			[...$this->getLessThanPair(false, false), true],
			[...$this->getGreaterThanPair(true, true), false],
			[...$this->getGreaterThanPair(false, true), false],
			[...$this->getGreaterThanPair(true, false), false],
			[...$this->getGreaterThanPair(false, false), false],
		];
	}

	public function equalsDataProvider()
	{
		return
		[
			[...$this->getEqualPair(true, true), true],
			[...$this->getEqualPair(false, true), true],
			[...$this->getEqualPair(true, false), true],
			[...$this->getEqualPair(false, false), true],
			[...$this->getLessThanPair(true, true), false],
			[...$this->getLessThanPair(false, true), false],
			[...$this->getLessThanPair(true, false), false],
			[...$this->getLessThanPair(false, false), false],
			[...$this->getGreaterThanPair(true, true), false],
			[...$this->getGreaterThanPair(false, true), false],
			[...$this->getGreaterThanPair(true, false), false],
			[...$this->getGreaterThanPair(false, false), false],
		];
	}
}