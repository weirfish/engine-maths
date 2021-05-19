<?php

namespace Engine\Maths;

class BigInt
{
	/** @var string[] */
	private array $numbers = [];
	
	public static function fromInt(int $int) : self
	{
		$return = new static();

		$return->numbers[] = (string)$int;

		return $return;
	}

	public static function fromStringArray(array $ints) : self
	{
		$return = new static();

		$return->numbers = $ints;

		return $return;
	}

	public static function fromString(string $string) : self
	{
		if(!is_numeric($string))
			throw new \LogicException("The given string is not numeric");

		$return = new static();

		for($i = 0; $i < strlen($string); $i += self::getMaxBlockLength())
		{
			$substr = substr($string, $i, self::getMaxBlockLength());

			$return->numbers[] = $substr;
		}

		return $return;
	}

	public static function getMaxBlockLength() : int
	{
		return strlen((string)PHP_INT_MAX) - 1;
	}

	public function getLength() : int
	{
		$length = 0;

		foreach($this->numbers as $number)
		{
			$length += strlen((string)$number);
		}

		return $length;
	}

	public function getHighestDigits() : int
	{
		return $this->numbers[0];
	}

	public function getLowestDigits() : BigInt
	{
		return new BigInt($this->numbers[count($this->numbers) - 1]);
	}

	public function getNumberString() : string
	{
		return implode("", $this->numbers);
	}

	public function getNumbers() : array
	{
		return $this->numbers;
	}

	public function toRadix()
	{
		$digits = $this->getHighestDigits();

		return RadixNumber::create()
		->setBase(10)
		->setExponent($this->getLength() - 1)
		->setSignificand((float)substr_replace($digits, ".", 1, 0));
	}

	public function __toString()
	{
		return $this->getNumberString();
	}

	public function __debugInfo()
	{
		return ["value" => (string)$this];
	}

	public function simplify()
	{
		return self::fromStringArray(str_split(implode($this->numbers), $this->getMaxBlockLength()));

	}
}