<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Exceptions\DifferentLengthException;
use Charlie\Randomizer\RandomizerInterface;

class CrossOver implements CrossOverInterface
{

    public function __construct(private RandomizerInterface $randomizer) {}

    public function run(Chromosome $chromosome1, Chromosome $chromosome2): array
    {
        $length1 = $chromosome1->getLength();
        $length2 = $chromosome2->getLength();

        if ($length1 !== $length2) {
            throw new DifferentLengthException(sprintf('Chromosomes to crossover have different lengths. Length of first chromosome: %d, length of second chromosome: %d', $length1, $length2));
        }

        $firstIndex = $chromosome1->getFirstIndex();
        $lastIndex = $chromosome1->getLastIndex();

        $crossOverPoint = $this->randomizer->getInteger($firstIndex, $lastIndex);
        $child1 = new Chromosome([]);
        $child2 = new Chromosome([]);

        for ($i = $firstIndex; $i < $crossOverPoint; $i++) {
            $child1->setGene($i, $chromosome1->getGene($i));
            $child2->setGene($i, $chromosome2->getGene($i));
        }
        for ($i = $crossOverPoint; $i <= $lastIndex; $i++) {
            $child1->setGene($i, $chromosome2->getGene($i));
            $child2->setGene($i, $chromosome1->getGene($i));
        }

        return [$child1, $child2];
    }

}