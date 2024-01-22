<?php

namespace Charlie\Population;

use Charlie\Actions\MutatorInterface;
use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\IndividualInterface;

class Population implements PopulationInterface
{

    /** @param IndividualInterface[] $individuals */
    public function __construct(private array $individuals) {

    }

    /**
     * @return IndividualInterface[]
     */
    public function getIndividuals(): array
    {
        return $this->individuals;
    }

    public function calculateFitness(CalculatorInterface $calculator): int
    {
        return array_reduce($this->individuals, fn(int $carry, IndividualInterface $individual) => $individual->calculateFitness($calculator) + $carry, 0);
    }

    /**
     * @param IndividualInterface[] $individualsToSearch
     * @param IndividualInterface[] $individualsToReplace
     */
    public function replaceIndividuals(array $individualsToSearch, array $individualsToReplace): void
    {
        for ($i = 0; $i < count($individualsToSearch); $i++) {
            $individualToSearch = $individualsToSearch[$i];
            $individualToReplace = $individualsToReplace[$i];

            $index = $this->findSameIndividualIndex($individualToSearch);
            if (null !== $index) {
                $this->individuals[$index] = $individualToReplace;
            }
        }
    }

    private function findSameIndividualIndex(IndividualInterface $individualToCompare): ?int
    {
        foreach ($this->individuals as $index => $individual) {
            if ($individual->isEqual($individualToCompare)) {
                return $index;
            }
        }
        return null;
    }

    public function mutate(MutatorInterface $mutator): void
    {
        foreach ($this->individuals as $index => $individual) {
            $individual->mutate($mutator);
            $this->individuals[$index] = $individual;
        }
    }

    public function __toString(): string
    {
        return implode(PHP_EOL . PHP_EOL, array_map(fn(IndividualInterface $individual) => (string) $individual, $this->individuals));
    }

}