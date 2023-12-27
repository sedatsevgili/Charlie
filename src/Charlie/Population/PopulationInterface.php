<?php

namespace Charlie\Population;

use Charlie\Actions\MutatorInterface;
use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\IndividualInterface;

interface PopulationInterface
{
    /** @var IndividualInterface[] $individuals */
    public function __construct(array $individuals);

    /** @var IndividualInterface[] */
    public function getIndividuals(): array;

    public function calculateFitness(CalculatorInterface $calculator): int;

    public function replaceIndividuals(array $individualsToSearch, array $individualsToReplace): void;

    public function mutate(MutatorInterface $mutator): void;
}