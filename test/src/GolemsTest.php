<?php

namespace Engine\Test\Maths;

class GolemsTest extends \PHPUnit\Framework\TestCase
{
	function test()
	{
		$startingCopiers = 25;

		$radix = new \Engine\Maths\RadixNumber($startingCopiers, 10, 0);
		
		$radix = \Engine\Maths\RadixMaths::simplify($radix);

		var_dump($radix);
	}
}