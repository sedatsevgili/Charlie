<?php

namespace Charlie\Actions;

use Charlie\Fitness\CalculatorInterface;
use Charlie\Population\PopulationInterface;

interface SelectionInterface
{

    public function select(PopulationInterface $population, CalculatorInterface $calculator): array;

}