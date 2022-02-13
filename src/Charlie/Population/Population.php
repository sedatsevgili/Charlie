<?php

namespace Charlie\Population;

use Charlie\Individual\IndividualInterface;

class Population implements PopulationInterface
{

    /** @var IndividualInterface[] $individuals */
    public function __construct(private array $individuals) {

    }

    public function getIndividuals(): array
    {
        return $this->individuals;
    }


}