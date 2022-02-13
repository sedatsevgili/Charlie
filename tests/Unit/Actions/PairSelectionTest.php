<?php

namespace Unit\Actions;

use Charlie\Actions\PairSelection;
use Charlie\Chromosome\Chromosome;
use Charlie\Fitness\DummySumCalculator;
use Charlie\Gene\ByteGene;
use Charlie\Individual\Individual;
use Charlie\Population\Population;
use PHPUnit\Framework\TestCase;

class PairSelectionTest extends TestCase
{

    public function testSelect()
    {
        /**
         * input:
         *  - 000100
         *  - 001100
         *  - 100011
         *  - 110100
         *  - 000000
         *  - 111110
         *
         * expected output:
         *  - 111110
         *  - 110100
         */


        $calculator = new DummySumCalculator();
        $population = new Population([
            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
            ])),

            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
            ])),

            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
            ])),

            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
            ])),

            new Individual(new Chromosome([
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
                (new ByteGene())->set(0),
            ])),

            new Individual(new Chromosome([
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(1),
                (new ByteGene())->set(0),
            ])),
        ]);

        $selection = new PairSelection();

        $pair = $selection->select($population, $calculator);
        $this->assertEquals('111110', (string)$pair[0]->chromosome);
        $this->assertEquals('110100', (string)$pair[1]->chromosome);
    }

}