<?php

namespace Charlie\Actions;

use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\IndividualInterface;
use Charlie\Population\PopulationInterface;

class PairSelection implements SelectionInterface
{

    /**
     * @param PopulationInterface $population
     * @param CalculatorInterface $calculator
     * @return IndividualInterface[]
     */
    public function selectBest(PopulationInterface $population, CalculatorInterface $calculator): array
    {
        $fittest1 = PHP_INT_MIN;
        $fittest2 = PHP_INT_MIN;
        $pair = [];

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);
            if ($fit > $fittest1) {
                $fittest1 = $fit;
                $pair[0] = $individual;
            }
        }

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);
            if ($fit > $fittest2 && $fit < $fittest1) {
                $fittest2 = $fit;
                $pair[1] = $individual;
            }
        }

        return $pair;
    }

    public function selectWorst(PopulationInterface $population, CalculatorInterface $calculator): array
    {
        $min1 = PHP_INT_MAX;
        $min2 = PHP_INT_MAX;
        $pair = [];

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);

            if ($fit < $min1) {
                $min1 = $fit;
                $pair[0] = $individual;
            }
        }

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);

            if ($fit < $min2 && $fit > $min1) {
                $min2 = $fit;
                $pair[1] = $individual;
            }
        }

        return $pair;
    }


}