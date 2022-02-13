<?php

namespace Charlie\Actions;

use Charlie\Fitness\CalculatorInterface;
use Charlie\Population\PopulationInterface;

interface SelectionInterface
{

    public function selectBest(PopulationInterface $population, CalculatorInterface $calculator): array;

    public function selectWorst(PopulationInterface $population, CalculatorInterface $calculator): array;

}