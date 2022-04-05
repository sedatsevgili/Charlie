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

    public function testReplaceIndividuals()
    {
        /**
         * Population:
         *  - 101
         *  - 000
         *  - 010
         *
         * Search Individuals:
         *  - 000
         *  - 101
         *
         * Replace Individuals:
         *  - 001
         *  - 111
         *
         * Expected Population:
         *  - 111
         *  - 001
         *  - 010
         */

        $initIndividuals = [
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

            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
            ])),
        ];

        $searchIndividuals = [
            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
            ])),
            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
            ]))

        ];

        $replaceIndividuals = [
            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
            ])),
            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
            ]))
        ];

        $expectedPopulation = new Population([
            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
            ])),
            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
            ])),
            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
            ])),
        ]);

        $population = new Population($initIndividuals);

        $population->replaceIndividuals($searchIndividuals, $replaceIndividuals);
        $newIndividuals = $population->getIndividuals();
        $this->assertEquals($newIndividuals, $expectedPopulation->getIndividuals());

    }

}