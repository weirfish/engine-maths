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

		$new_exponent = log($number->getSignificand(), $base) + ($number->getExponent() * log($number->getBase(), $base));

		$new_significand = pow($base, fmod($new_exponent, 1));
		$new_exponent    = floor($new_exponent);

		return self::reduce
		(
			RadixNumber::create()
			->setBase($base)
			->setExponent($new_exponent)
			->setSignificand($new_significand)
		);
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
		$b_in_base_a = self::convertToBase($b, $a->getBase());

		$b_in_exponent_a = self::convertToExponent($b_in_base_a, $a->getExponent());

		$result = RadixNumber::create()
		->setExponent($a->getExponent())
		->setBase($a->getBase())
		->setSignificand($a->getSignificand() + $b_in_exponent_a->getSignificand());

		return self::reduce($result);
	}

	public static function subtract(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$b_in_negative = (clone $b)
		->setSignificand($b->getSignificand() * -1);

		return self::add($a, $b_in_negative);
	}

	public static function multiply(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$b_in_base_a = self::convertToBase($b, $a->getBase());

		$result = RadixNumber::create()
		->setBase($a->getBase())
		->setSignificand($a->getSignificand() * $b_in_base_a->getSignificand())
		->setExponent($a->getExponent() + $b_in_base_a->getExponent());

		return self::reduce($result);
	}

	public static function divide(RadixNumber $a, RadixNumber $b) : RadixNumber
	{
		$b_in_base_a = self::convertToBase($b, $a->getBase());

		$result = RadixNumber::create()
		->setBase($a->getBase())
		->setSignificand($a->getSignificand() / $b_in_base_a->getSignificand())
		->setExponent($a->getExponent() - $b_in_base_a->getExponent());

		return self::reduce($result);
	}

	public static function reduce(RadixNumber $a) : RadixNumber
	{
		$copy = clone $a;

		while($copy->getSignificand() / $copy->getBase() >= 1)
		{
			$copy->setSignificand($copy->getSignificand() / $copy->getBase());
			$copy->setExponent($copy->getExponent() + 1);
		}

		return $copy;
	}
}

