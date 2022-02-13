<?php

namespace Charlie\Individual;

use Charlie\Chromosome\Chromosome;
use Charlie\Fitness\CalculatorInterface;

class Individual implements IndividualInterface
{

    public function __construct(public Chromosome $chromosome) {}

    public function calculateFitness(CalculatorInterface $calculator): int
    {
        return $calculator->calculate($this->chromosome);
    }


}