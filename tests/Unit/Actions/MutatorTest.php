<?php

namespace Unit\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Gene\ByteGene;
use Charlie\Actions\Mutator;
use Charlie\Randomizer\MtRandomizer;
use PHPUnit\Framework\TestCase;

class MutatorTest extends TestCase
{

    public function testMutate()
    {
        // input:                   1111100000
        // expected output:         1110000000

        $mockedRandomizer = $this->getMockBuilder(MtRandomizer::class)
            ->onlyMethods(['getInteger'])
            ->getMock();

        $mockedRandomizer
            ->expects($this->exactly(3))
            ->method('getInteger')
            ->withConsecutive(
                [1, 500],
                [1, 10],
                [0, 8]
            )
            ->willReturnOnConsecutiveCalls(
                1,
                2,
                3
            );

        $inputChromosome = new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
            (new ByteGene())->set(0)
        ]);

        $mutator = new Mutator($mockedRandomizer);
        $mutatedChromosome = $mutator->mutate($inputChromosome);

        $this->assertEquals('1110000000', (string) $mutatedChromosome);
    }

}