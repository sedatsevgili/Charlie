<?php

namespace Charlie\Fitness;

use Charlie\Chromosome\Chromosome;
use Charlie\Gene\GeneInterface;

/**
 * Calculates fitness of chromosomes by just adding their integer values
 */
class DummySumCalculator implements CalculatorInterface
{

    public function calculate(Chromosome $chromosome): int
    {
        return array_reduce($chromosome->getData(), fn(int $carry, GeneInterface $gene) => $carry + (int) $gene->get(), 0);
    }


}