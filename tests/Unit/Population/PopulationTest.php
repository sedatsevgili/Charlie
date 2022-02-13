<?php

namespace Unit\Population;

use Charlie\Chromosome\Chromosome;
use Charlie\Gene\ByteGene;
use Charlie\Individual\Individual;
use Charlie\Population\Population;
use PHPUnit\Framework\TestCase;

class PopulationTest extends TestCase
{

    public function testGetIndividuals()
    {
        $individuals = [
            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
            ])),

            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
            ])),
        ];

        $population = new Population($individuals);
        $this->assertEquals($individuals, $population->getIndividuals());
    }

}