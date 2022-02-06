<?php

namespace Charlie\Fitness;

use Charlie\Chromosome\Chromosome;

interface CalculatorInterface
{

    public function calculate(Chromosome $chromosome): int;

}