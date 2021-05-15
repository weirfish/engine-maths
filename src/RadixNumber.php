<?php

namespace Engine\Maths;

class RadixNumber
{
	use \Engine\Traits\Creatable;

	private int $base;
	private float $significand;
	private int $exponent;

	public function __construct(?float $sig = null, ?int $base = null, ?int $exp = null)
	{
		if($sig !== null)
			$this->significand = $sig;

		if($base !== null)
			$this->base = $base;
		
		if($exp !== null)
			$this->exponent = $exp;
	}

	public function getExponent() : int
	{
		return $this->exponent;
	}
	public function setExponent(int $exponent) : self
	{
		$this->exponent = $exponent;
	
		return $this;
	}
	public function getSignificand() : float
	{
		return $this->significand;
	}
	public function setSignificand(float $significand) : self
	{
		$this->significand = $significand;
	
		return $this;
	}

	public function getBase() : int
	{
		return $this->base;
	}
	public function setBase(int $base) : self
	{
		$this->base = $base;
	
		return $this;
	}

	public function __toString()
	{
		return $this->significand . "x" . $this->base . "^" . $this->exponent;
	}

	public function __debugInfo()
	{
		return [(string)$this];
	}

	public function round($precision = 4) : self
	{
		$this->significand = round($this->significand, $precision);

		return $this;
	}
}