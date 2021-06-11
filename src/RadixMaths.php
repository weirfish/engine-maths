<?php

namespace Engine\Maths;

class RadixMaths
{
	public static function convertToBase(RadixNumber $number, int $base) : RadixNumber
	{
		// na^x = mb^y
		// m = b^z
		// na^x = b^z * b^y
		// log[b](na^x) = log[b](b^z * b^y)
		//              = log[b](b^z) + log[b](b^y)
		//              = z + y
		// log[b](n) + xlog[b](a) = z + y
		// Where y is an integer, and z is the remaining decimal

		$newExponent = log(abs($number->getSignificand()), $base) + ($number->getExponent() * log($number->getBase(), $base));

		$significandSign = $number->getSign();

		$newSignificand = $significandSign * pow($base, fmod($newExponent, 1));
		$newExponent    = (int)floor($newExponent);

		return RadixNumber::create()
		->setBase($base)
		->setExponent($newExponent)
		->setSignificand($newSignificand)
		->simplify();
	}

	public static function convertToExponent(RadixNumber $number, int $exponent) : RadixNumber
	{
		$copy = clone $number;

		while($copy->getExponent() !== $exponent)
		{
			if($copy->getExponent() > $exponent)
			{
				$copy->setSignificand($copy->getSignificand() * $copy->getBase());
				$copy->setExponent($copy->getExponent() - 1);
			}
			else
			{
				$copy->setSignificand($copy->getSignificand() / $copy->getBase());
				$copy->setExponent($copy->getExponent() + 1);
			}
		}

		return $copy;
	}

	public static function add(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());

		$bInExponentA = self::convertToExponent($bInBaseA, $a->getExponent());

		$result = RadixNumber::create()
		->setExponent($a->getExponent())
		->setBase($a->getBase())
		->setSignificand($a->getSignificand() + $bInExponentA->getSignificand());

		return $result->simplify();
	}

	public static function subtract(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$bInNegative = (clone $b)
		->setSignificand($b->getSignificand() * -1);

		return self::add($a, $bInNegative);
	}

	public static function multiply(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());

		$result = RadixNumber::create()
		->setBase($a->getBase())
		->setSignificand($a->getSignificand() * $bInBaseA->getSignificand())
		->setExponent($a->getExponent() + $bInBaseA->getExponent());

		return $result->simplify();
	}

	public static function divide(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());

		$result = RadixNumber::create()
		->setBase($a->getBase())
		->setSignificand($a->getSignificand() / $bInBaseA->getSignificand())
		->setExponent($a->getExponent() - $bInBaseA->getExponent());

		return $result->simplify();
	}

	public static function isEqual(RadixNumber $a, RadixNumber $b) : bool
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());
		$bInExponentA  = self::convertToExponent($bInBaseA, $a->getExponent());

		return round($bInExponentA->getSignificand(), 10) == round($a->getSignificand(), 10);
	}

	public static function isLessThan(RadixNumber $a, RadixNumber $b) : bool
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());
		$bInExponentA  = self::convertToExponent($bInBaseA, $a->getExponent());

		return round($bInExponentA->getSignificand(), 10) < round($a->getSignificand(), 10);
	}

	public static function isLessThanOrEqual(RadixNumber $a, RadixNumber $b) : bool
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());
		$bInExponentA  = self::convertToExponent($bInBaseA, $a->getExponent());

		return round($bInExponentA->getSignificand(), 10) <= round($a->getSignificand(), 10);
	}

	public static function isGreaterThan(RadixNumber $a, RadixNumber $b) : bool
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());
		$bInExponentA  = self::convertToExponent($bInBaseA, $a->getExponent());

		return round($bInExponentA->getSignificand(), 10) > round($a->getSignificand(), 10);
	}

	public static function isGreaterThanOrEqual(RadixNumber $a, RadixNumber $b) : bool
	{
		$bInBaseA = self::convertToBase($b, $a->getBase());
		$bInExponentA  = self::convertToExponent($bInBaseA, $a->getExponent());

		return round($bInExponentA->getSignificand(), 10) >= round($a->getSignificand(), 10);
	}
}

