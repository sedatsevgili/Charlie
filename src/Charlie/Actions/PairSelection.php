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
    public function select(PopulationInterface $population, CalculatorInterface $calculator): array
    {
        $fittest1 = PHP_INT_MIN;
        $fittest1Individual = null;
        $fittest2 = PHP_INT_MIN;
        $fittest2Individual = null;

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);
            if ($fit > $fittest1) {
                $fittest1 = $fit;
                $fittest1Individual = $individual;
                continue;
            }

            if ($fit > $fittest2) {
                $fittest2 = $fit;
                $fittest2Individual = $individual;
                continue;
            }
        }

        return [$fittest1Individual, $fittest2Individual];
    }


}