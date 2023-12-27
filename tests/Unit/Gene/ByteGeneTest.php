<?php
declare(strict_types=1);

namespace Unit\Gene;

use Charlie\Gene\ByteGene;
use PHPUnit\Framework\TestCase;

class ByteGeneTest extends TestCase
{

    public function testSetAndGet()
    {
        $gene = new ByteGene();
        $gene->set(true);
        $this->assertEquals(true, $gene->get());
        $this->assertEquals('1', (string) $gene);

        $gene->set(false);
        $this->assertEquals(false, $gene->get());
        $this->assertEquals('0', (string) $gene);
    }

    public function testMutate()
    {
        $gene = new ByteGene();
        $gene->set(true);

        $gene->mutate();
        $this->assertEquals(false, $gene->get());

        $gene->mutate();
        $this->assertEquals(true, $gene->get());
    }

    public function testIsEqual()
    {
        $gene1 = new ByteGene();
        $gene1->set(true);

        $gene2 = new ByteGene();
        $gene2->set(true);

        $gene3 = new ByteGene();
        $gene3->set(false);

        $this->assertTrue($gene1->isEqual($gene2));
        $this->assertTrue($gene2->isEqual($gene1));

        $this->assertFalse($gene1->isEqual($gene3));
        $this->assertFalse($gene3->isEqual($gene1));
    }

}