<?php

namespace Engine\Maths;

class BigIntMaths
{
	public static function add(BigInt $a, BigInt $b) : BigInt
	{
		$aNums = array_reverse($a->getNumbers());
		$bNums = array_reverse($b->getNumbers());

		$returnNums = [];
		$carry       = false;

		for($i = 0; $i < max(count($aNums), count($bNums)); $i++)
		{
			$returnNum = $aNums[$i] + $bNums[$i] + ($carry ? 1 : 0);

			if(strlen((string)$returnNum) > BigInt::getMaxBlockLength())
			{
				$carry      = true;
				$returnNum = substr((string)$returnNum, 1);
			}

			$returnNums[] = $returnNums;
		}

		return BigInt::fromStringArray($returnNums);
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

		$aNums = $a->getNumbers();
		$bNums = $b->getNumbers();

		// Otherwise, compare them from most significant block down.
		for($i = 0; $i < count($aNums); $i++)
		{
			if(($aNums[$i] <=> $bNums[$i]) !== 0)
				return $aNums[$i] <=> $bNums[$i];
		}

		return 0;
	}
}