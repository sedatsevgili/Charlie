<?php

namespace Unit\Fitness;

use Charlie\Chromosome\Chromosome;
use Charlie\Fitness\DummySumCalculator;
use Charlie\Gene\ByteGene;
use PHPUnit\Framework\TestCase;

class DummySumCalculatorTest extends TestCase
{

    public function testCalculate()
    {
        $calculator = new DummySumCalculator();

        // input chromosome1:   1010
        // output fitness1:     2

        $chr1 = new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
            (new ByteGene())->set(0)
        ]);

        $this->assertEquals(2, $calculator->calculate($chr1));

        // input chromosome2:   0111
        // output fitness2:     3

        $chr2 = new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
        ]);
        $this->assertEquals(3, $calculator->calculate($chr2));
    }

}