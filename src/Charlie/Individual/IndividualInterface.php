<?php

namespace Charlie\Individual;

use Charlie\Actions\MutatorInterface;
use Charlie\Fitness\CalculatorInterface;

interface IndividualInterface
{

    public function calculateFitness(CalculatorInterface $calculator): int;

    public function isEqual(IndividualInterface $individual): bool;

    public function mutate(MutatorInterface $mutator): void;

}