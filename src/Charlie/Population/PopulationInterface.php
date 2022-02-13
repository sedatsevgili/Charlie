<?php

namespace Charlie\Population;

use Charlie\Individual\IndividualInterface;

interface PopulationInterface
{
    /** @var IndividualInterface[] $individuals */
    public function __construct(array $individuals);

    /** @var IndividualInterface[] */
    public function getIndividuals(): array;
}