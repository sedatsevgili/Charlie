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
        $this->assertEquals('0|1', (string) $chromosome);

    }

    public function testNotFoundException()
    {
        $this->expectException(GeneNotFoundException::class);

        $chromosome = new Chromosome([1 => new ByteGene()]);
        $chromosome->getGene(2);
    }

    public function testIsEqual()
    {
        $chromosome1 = new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
        ]);

        $chromosome2 = new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
        ]);

        $this->assertTrue($chromosome1->isEqual($chromosome2));
        $this->assertTrue($chromosome2->isEqual($chromosome1));

        $chromosome3 = new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(0),
        ]);

        $this->assertFalse($chromosome1->isEqual($chromosome3));
        $this->assertFalse($chromosome3->isEqual($chromosome1));
    }

    public function testCopyFrom()
    {
        $chromosome1 = new Chromosome([
            (new ByteGene())->set(1),
            (new ByteGene())->set(0),
        ]);

        $chromosome2 = new Chromosome([
            (new ByteGene())->set(0),
            (new ByteGene())->set(1),
        ]);

        $chromosome1->copyFrom($chromosome2);

        $this->assertTrue($chromosome1->isEqual($chromosome2));
        $this->assertTrue($chromosome2->isEqual($chromosome1));
    }

}