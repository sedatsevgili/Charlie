<?php

namespace Unit\Randomizer;

use Charlie\Randomizer\MtRandomizer;
use PHPUnit\Framework\TestCase;

class MtRandomizerTest extends TestCase
{

    public function testGetInteger()
    {
        $min = 3;
        $max = 5;

        $randomizer = new MtRandomizer();
        $actualResult = $randomizer->getInteger($min, $max);

        $this->assertGreaterThanOrEqual($min, $actualResult);
        $this->assertLessThanOrEqual($max, $actualResult);
    }

}