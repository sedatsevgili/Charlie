<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Exceptions\DifferentLengthException;
use Charlie\Randomizer\RandomizerInterface;

class CrossOver implements CrossOverInterface
{

    public function __construct(private RandomizerInterface $randomizer) {}

    public function run(Chromosome $chromosome1, Chromosome $chromosome2): Chromosome
    {
        $length1 = $chromosome1->getLength();
        $length2 = $chromosome2->getLength();
        $offspring = new Chromosome([]);

        if ($length1 !== $length2) {
            throw new DifferentLengthException(sprintf('Chromosomes to crossover have different lengths. Length of first chromosome: %d, length of second chromosome: %d', $length1, $length2));
        }

        $firstIndex = $chromosome1->getFirstIndex();
        $lastIndex = $chromosome1->getLastIndex();

        $crossOverPoint = $this->randomizer->getInteger($firstIndex, $lastIndex);

        for ($i = $firstIndex; $i < $crossOverPoint; $i++) {
            $offspring->setGene($i, $chromosome1->getGene($i));
        }
        for ($i = $crossOverPoint; $i <= $lastIndex; $i++) {
            $offspring->setGene($i, $chromosome2->getGene($i));
        }

        return $offspring;
    }

}