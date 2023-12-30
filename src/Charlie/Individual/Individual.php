<?php

namespace Charlie\Individual;

use Charlie\Actions\MutatorInterface;
use Charlie\Chromosome\Chromosome;
use Charlie\Fitness\CalculatorInterface;

class Individual implements IndividualInterface
{

    public function __construct(private Chromosome $chromosome) {}

    public function calculateFitness(CalculatorInterface $calculator): int
    {
        return $calculator->calculate($this->chromosome);
    }

    public function isEqual(IndividualInterface $individual): bool
    {
        return $this->chromosome->isEqual($individual->getChromosome());
    }

    public function mutate(MutatorInterface $mutator): void
    {
        $this->chromosome = $mutator->mutate($this->chromosome);
    }

    public function __toString(): string
    {
        return (string) $this->chromosome;
    }

    public function getChromosome(): Chromosome
    {
        return $this->chromosome;
    }

}