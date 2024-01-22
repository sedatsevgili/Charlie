<?php

namespace Charlie\Population;

use Charlie\Actions\MutatorInterface;
use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\IndividualInterface;

interface PopulationInterface
{
    /** @param IndividualInterface[] $individuals */
    public function __construct(array $individuals);

    /** @return IndividualInterface[] */
    public function getIndividuals(): array;

    public function calculateFitness(CalculatorInterface $calculator): int;

    /**
     * @param array<IndividualInterface> $individualsToSearch
     * @param array<IndividualInterface> $individualsToReplace
     * @return void
     */
    public function replaceIndividuals(array $individualsToSearch, array $individualsToReplace): void;

    public function mutate(MutatorInterface $mutator): void;

    public function __toString(): string;
}