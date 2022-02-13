<?php

namespace Unit\Actions;

use Charlie\Actions\CrossOver;
use Charlie\Chromosome\Chromosome;
use Charlie\Gene\ByteGene;
use Charlie\Randomizer\MtRandomizer;
use PHPUnit\Framework\TestCase;

class CrossOverTest extends TestCase
{

    public function testRun()
    {
        // input1:              '111000'
        // input2:              '000010'

        // crossover point: 3
        // expected output:     '111010', '000000'

        $randomizer = $this->getMockBuilder(MtRandomizer::class)
            ->onlyMethods(['getInteger'])
            ->getMock();

        $randomizer
            ->expects($this->exactly(1))
            ->method('getInteger')
            ->with($this->equalTo(0), $this->equalTo(5))
            ->willReturn(3);

        $crossOver = new CrossOver($randomizer);

        $chromosome1 = new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0)
        ]);

        $chromosome2 = new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
        ]);

        $children = $crossOver->run($chromosome1, $chromosome2);

        $this->assertEquals('111010', (string) $children[0]);
        $this->assertEquals('000000', (string) $children[1]);
    }

}