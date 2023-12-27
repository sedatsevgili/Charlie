<?php

namespace Charlie\Actions\Problem;

use Charlie\Actions\CrossOverInterface;
use Charlie\Actions\MutatorInterface;
use Charlie\Actions\SelectionInterface;
use Charlie\Fitness\CalculatorInterface;
use Charlie\Population\PopulationInterface;

/**
 * Class Problem
 * @package Charlie\Problem
 *
 */
class Problem
{

    private PopulationInterface $population;

    private CalculatorInterface $calculator;

    private SelectionInterface $selection;

    private CrossOverInterface $crossOver;

    private MutatorInterface $mutator;

    private int $maxEvolveCount;

    public function setPopulation(PopulationInterface $population): void
    {
        $this->population = $population;
    }

    /**
     * @return PopulationInterface
     */
    public function getPopulation(): PopulationInterface
    {
        return $this->population;
    }



    public function setCalculator(CalculatorInterface $calculator): void
    {
        $this->calculator = $calculator;
    }

    /**
     * @param SelectionInterface $selection
     */
    public function setSelection(SelectionInterface $selection): void
    {
        $this->selection = $selection;
    }

    /**
     * @param CrossOverInterface $crossOver
     */
    public function setCrossOver(CrossOverInterface $crossOver): void
    {
        $this->crossOver = $crossOver;
    }

    /**
     * @param MutatorInterface $mutator
     */
    public function setMutator(MutatorInterface $mutator): void
    {
        $this->mutator = $mutator;
    }


    public function setMaxEvolveCount(int $maxEvolveCount): void
    {
        $this->maxEvolveCount = $maxEvolveCount;
    }

    public function solve(): void
    {
        $previousFitnessOfPopulation = PHP_INT_MIN;
        for ($i = 0; $i < $this->maxEvolveCount; $i++) {
            $this->log(sprintf("Generation: %d", $i));
            $fitness = $this->population->calculateFitness($this->calculator);
            $this->log(sprintf("Fitness: %d", $fitness));

            if ($fitness < $previousFitnessOfPopulation) {
                $this->log(sprintf("Fitness: %d, previous fitness: %d", $fitness, $previousFitnessOfPopulation));
                return;
            }

            $bestParents = $this->selection->selectBest($this->population, $this->calculator);
            $offsprings = $this->crossOver->runForIndividuals($bestParents->getIndividual1(), $bestParents->getIndividual2());

            $worstParents = $this->selection->selectWorst($this->population, $this->calculator);
            $this->population->replaceIndividuals($worstParents->toArray(), $offsprings);

            $previousFitnessOfPopulation = $this->population->calculateFitness($this->calculator);

            $this->population->mutate($this->mutator);

            $this->log((string) $this->population);
            $this->log("====================================");
        }
    }

    private function log(string $message): void
    {
        echo $message . PHP_EOL;
    }

}