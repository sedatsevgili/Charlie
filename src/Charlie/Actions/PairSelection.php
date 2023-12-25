<?php

namespace Charlie\Actions;

use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\IndividualInterface;
use Charlie\Individual\Pair;
use Charlie\Population\PopulationInterface;

class PairSelection implements SelectionInterface
{

    public function selectBest(PopulationInterface $population, CalculatorInterface $calculator): Pair
    {
        $fittest1 = PHP_INT_MIN;
        $fittest2 = PHP_INT_MIN;
        $individual1 = null;
        $individual2 = null;

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
        $min1 = PHP_INT_MAX;
        $min2 = PHP_INT_MAX;
        $individual1 = null;
        $individual2 = null;

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);

            if ($fit < $min1) {
                $min1 = $fit;
                $individual1 = $individual;
            }
        }

        foreach ($population->getIndividuals() as $individual) {
            $fit = $individual->calculateFitness($calculator);

            if ($fit < $min2 && $fit > $min1) {
                $min2 = $fit;
                $individual2 = $individual;
            }
        }

        return new Pair($individual1, $individual2);
    }


}