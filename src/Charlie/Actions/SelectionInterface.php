<?php

namespace Charlie\Actions;

use Charlie\Fitness\CalculatorInterface;
use Charlie\Individual\Pair;
use Charlie\Population\PopulationInterface;

interface SelectionInterface
{

    public function selectBest(PopulationInterface $population, CalculatorInterface $calculator): Pair;

    public function selectWorst(PopulationInterface $population, CalculatorInterface $calculator): Pair;

}