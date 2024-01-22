<?php

namespace Charlie\Actions;

use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\IndividualInterface;
use Charlie\Individual\Pair;
use Charlie\Population\PopulationInterface;
use Charlie\Util\PopulationUtilities;

class PairSelection implements SelectionInterface
{

    public function selectBest(PopulationInterface $population, CalculatorInterface $calculator): Pair
    {
        $firstIndividuals = PopulationUtilities::getFirstIndividuals($population, 2);
        $individual1 = $firstIndividuals[0];
        $individual2 = $firstIndividuals[1];
        $fittest1 = $individual1->calculateFitness($calculator);
        $fittest2 = $individual2->calculateFitness($calculator);

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);
            if ($fit > $fittest1) {
                $fittest1 = $fit;
                $individual1 = $individual;
            }
        }

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);
            if ($fit > $fittest2 && $fit < $fittest1) {
                $fittest2 = $fit;
                $individual2 = $individual;
            }
        }

        return new Pair($individual1, $individual2);
    }

    public function selectWorst(PopulationInterface $population, CalculatorInterface $calculator): Pair
    {
        $firstIndividuals = PopulationUtilities::getFirstIndividuals($population, 2);
        $individual1 = $firstIndividuals[0];
        $individual2 = $firstIndividuals[1];
        $fittest1 = $individual1->calculateFitness($calculator);
        $fittest2 = $individual2->calculateFitness($calculator);

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);

            if ($fit < $fittest1) {
                $fittest1 = $fit;
                $individual1 = $individual;
            }
        }

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);

            if ($fit < $fittest2 && $fit > $fittest1) {
                $fittest2 = $fit;
                $individual2 = $individual;
            }
        }

        return new Pair($individual1, $individual2);
    }


}