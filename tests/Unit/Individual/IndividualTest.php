<?php

namespace Unit\Individual;

use Charlie\Chromosome\Chromosome;
use Charlie\Fitness\DummySumCalculator;
use Charlie\Gene\ByteGene;
use Charlie\Individual\Individual;
use PHPUnit\Framework\TestCase;

class IndividualTest extends TestCase
{

    public function testCalculateFitness()
    {

        // input:                   '11010'
        // expected output:         3

        $individual = new Individual(new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
        ]));
        $calculator = new DummySumCalculator();

        $this->assertEquals(3, $individual->calculateFitness($calculator));
    }

    public function testIsEqual()
    {
        $individual1 = new Individual(new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
        ]));

        $individual2 = new Individual(new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
        ]));

        $individual3 = new Individual(new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(0)
        ]));

        $this->assertTrue($individual1->isEqual($individual2));
        $this->assertTrue($individual2->isEqual($individual1));

        $this->assertFalse($individual3->isEqual($individual1));
        $this->assertFalse($individual3->isEqual($individual2));

    }

}