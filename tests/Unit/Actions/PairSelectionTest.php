<?php

namespace Unit\Actions;

use Charlie\Actions\PairSelection;
use Charlie\Chromosome\Chromosome;
use Charlie\Fitness\DummySumCalculator;
use Charlie\Gene\ByteGene;
use Charlie\Individual\Individual;
use Charlie\Population\Population;
use Charlie\Util\StringUtilities;
use PHPUnit\Framework\TestCase;

class PairSelectionTest extends TestCase
{

    public function testSelectBest()
    {
        /**
         * input:
         *  - 000100
         *  - 001100
         *  - 110011
         *  - 110100
         *  - 000000
         *  - 111110
         *
         * expected output:
         *  - 111110
         *  - 110011
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
                (new ByteGene())->set(1),
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

        $pair = $selection->selectBest($population, $calculator);
        $this->assertEquals('111110', (string)$pair->getIndividual1()->getChromosome());
        $this->assertEquals('110011', (string)$pair->getIndividual2()->getChromosome());
    }


    public function testSelectWorst()
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
         *  - 000000
         *  - 000100
         */


        $calculator = new DummySumCalculator();
        $population = new Population([
            StringUtilities::createIndividualWithByteGenes('000100'),
            StringUtilities::createIndividualWithByteGenes('001100'),
            StringUtilities::createIndividualWithByteGenes('100011'),
            StringUtilities::createIndividualWithByteGenes('110100'),
            StringUtilities::createIndividualWithByteGenes('000000'),
            StringUtilities::createIndividualWithByteGenes('111110'),
        ]);

        $selection = new PairSelection();

        $pair = $selection->selectWorst($population, $calculator);
        $this->assertEquals('000000', (string)$pair->getIndividual1()->getChromosome());
        $this->assertEquals('000100', (string)$pair->getIndividual2()->getChromosome());
    }



}