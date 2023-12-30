<?php

namespace Charlie\Util;

use Charlie\Individual\IndividualInterface;
use Charlie\Population\PopulationInterface;

class PopulationUtilities
{

    /**
     * @param PopulationInterface $population
     * @param int $count
     * @return array<IndividualInterface>
     */
    public static function getFirstIndividuals(PopulationInterface $population, int $count): array
    {
        if ($count > count($population->getIndividuals())) {
            throw new \InvalidArgumentException('Count cannot be greater than the number of individuals in the population');
        }
        return array_slice($population->getIndividuals(), 0, $count);
    }

}