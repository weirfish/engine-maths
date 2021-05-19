<?php

namespace Engine\Maths;

class BigIntMaths
{
	public static function add(BigInt $a, BigInt $b) : BigInt
	{
		$a_nums = array_reverse($a->getNumbers());
		$b_nums = array_reverse($b->getNumbers());

		$return_nums = [];
		$carry       = false;

		for($i = 0; $i < max(count($a_nums), count($b_nums)); $i++)
		{
			$return_num = $a_nums[$i] + $b_nums[$i] + ($carry ? 1 : 0);

			if(strlen((string)$return_num) > BigInt::getMaxBlockLength())
			{
				$carry      = true;
				$return_num = substr((string)$return_num, 1);
			}

			$return_nums[] = $return_nums;
		}

		return BigInt::fromStringArray($return_nums);
	}
	public static function subtract(BigInt $a, BigInt $b) : BigInt
	{
		return BigInt::fromInt(0);
	}
	public static function multiply(BigInt $a, BigInt $b) : BigInt
	{
		return BigInt::fromInt(0);
	}
	public static function divide(BigInt $a, BigInt $b) : BigInt
	{
		return BigInt::fromInt(0);
	}

	public static function addMany(BigInt ...$vals) : BigInt
	{
		$result = BigInt::fromInt(0);

		foreach($vals as $val)
		{
			$result = self::add($result, $val);
		}

		return $result;
	}
	public static function subtractMany(BigInt ...$vals) : BigInt
	{
		$result = $vals[0];

		for($i = 1; $i < count($vals); $i++)
		{
			$result = self::subtract($result, $vals[$i]);
		}

		return $result;
	}
	public static function multiplyMany(BigInt ...$vals) : BigInt
	{
		$result = BigInt::fromInt(1);

		foreach($vals as $val)
		{
			$result = self::multiply($result, $val);
		}

		return $result;
	}
	public static function divideMany(BigInt ...$vals) : BigInt
	{
		$result = $vals[0];

		for($i = 1; $i < count($vals); $i++)
		{
			$result = self::divide($result, $vals[$i]);
		}

		return $result;
	}

	public static function compare(BigInt $a, BigInt $b) : int
	{
		// If one is longer than the other, it's bigger
		if(($a->getLength() <=> $b->getLength()) !== 0)
			return $a->getLength() <=> $b->getLength();

		$a_nums = $a->getNumbers();
		$b_nums = $b->getNumbers();

		// Otherwise, compare them from most significant block down.
		for($i = 0; $i < count($a_nums); $i++)
		{
			if(($a_nums[$i] <=> $b_nums[$i]) !== 0)
				return $a_nums[$i] <=> $b_nums[$i];
		}

		return 0;
	}
}