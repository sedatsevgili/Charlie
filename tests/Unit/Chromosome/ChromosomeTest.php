<?php

namespace Unit\Chromosome;

use Charlie\Chromosome\Chromosome;
use Charlie\Exceptions\GeneNotFoundException;
use Charlie\Gene\ByteGene;
use PHPUnit\Framework\TestCase;

class ChromosomeTest extends TestCase
{

    public function testSetAndGetGene()
    {
        $gene = new ByteGene();
        $gene->set(false);

        $index = 0;

        $chromosome = new Chromosome([
            $index => $gene
        ]);

        $this->assertEquals($gene, $chromosome->getGene($index));
        $this->assertEquals([$index => $gene], $chromosome->getData());
        $this->assertEquals(1, $chromosome->getLength());
        $this->assertEquals('0', (string)$chromosome);

        $chromosome->setGene(1, ((new ByteGene())->set(true)));
        $this->assertEquals(2, $chromosome->getLength());
        $this->assertEquals('01', (string) $chromosome);

    }

    public function testNotFoundException()
    {
        $this->expectException(GeneNotFoundException::class);

        $chromosome = new Chromosome([1 => new ByteGene()]);
        $chromosome->getGene(2);
    }



}