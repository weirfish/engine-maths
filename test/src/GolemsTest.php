<?php

namespace Engine\Test\Maths;

class GolemsTest extends \PHPUnit\Framework\TestCase
{
	function test()
	{
		$starting_copiers = 25;

		$radix = new \Engine\Maths\RadixNumber($starting_copiers, 10, 0);
		
		$radix = \Engine\Maths\RadixMaths::simplify($radix);

		var_dump($radix);
	}
}