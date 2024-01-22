<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Individual\IndividualInterface;

interface CrossOverInterface
{

    /**
     * @param Chromosome $chromosome1
     * @param Chromosome $chromosome2
     * @return Chromosome[]
     */
    public function run(Chromosome $chromosome1, Chromosome $chromosome2): array;

    /**
     * @param IndividualInterface $individual1
     * @param IndividualInterface $individual2
     * @return IndividualInterface[]
     */
    public function runForIndividuals(IndividualInterface $individual1, IndividualInterface $individual2): array;

}