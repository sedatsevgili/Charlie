<?php

namespace Unit\Individual;

use Charlie\Chromosome\Chromosome;
use Charlie\Individual\Individual;
use Charlie\Individual\Pair;
use Charlie\Util\StringUtilities;
use PHPUnit\Framework\TestCase;

class PairTest extends TestCase
{

    public function testGetIndividual1()
    {
        $individual1 = StringUtilities::createIndividualWithByteGenes('101010');
        $individual2 = StringUtilities::createIndividualWithByteGenes('010101');

        $pair = new Pair($individual1, $individual2);

        $this->assertEquals($individual1, $pair->getIndividual1());
    }

    public function testGetIndividual2()
    {
        $individual1 = StringUtilities::createIndividualWithByteGenes('101010');
        $individual2 = StringUtilities::createIndividualWithByteGenes('010101');

        $pair = new Pair($individual1, $individual2);

        $this->assertEquals($individual2, $pair->getIndividual2());
    }

    public function testToString()
    {
        $individual1 = StringUtilities::createIndividualWithByteGenes('101010');
        $individual2 = StringUtilities::createIndividualWithByteGenes('010101');

        $pair = new Pair($individual1, $individual2);

        $this->assertEquals($individual1 . ' ' . $individual2, (string) $pair);
    }

}