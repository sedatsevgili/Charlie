<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Individual\IndividualInterface;

interface CrossOverInterface
{

    public function run(Chromosome $chromosome1, Chromosome $chromosome2): array;

    public function runForIndividuals(IndividualInterface $individual1, IndividualInterface $individual2): array;

}