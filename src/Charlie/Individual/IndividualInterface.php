<?php

namespace Charlie\Individual;

use Charlie\Fitness\CalculatorInterface;

interface IndividualInterface
{

    public function calculateFitness(CalculatorInterface $calculator): int;

}