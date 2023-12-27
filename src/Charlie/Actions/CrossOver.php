<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Exceptions\DifferentLengthException;
use Charlie\Individual\Individual;
use Charlie\Individual\IndividualInterface;
use Charlie\Randomizer\RandomizerInterface;

class CrossOver implements CrossOverInterface
{

    public function __construct(private RandomizerInterface $randomizer) {}

    public function run(Chromosome $chromosome1, Chromosome $chromosome2): array
    {
        $length1 = $chromosome1->getLength();
        $length2 = $chromosome2->getLength();

        if ($length1 !== $length2) {
            throw new DifferentLengthException(sprintf('Chromosomes to crossover have different lengths. Length of first chromosome: %d, length of second chromosome: %d', $length1, $length2));
        }

        $firstIndex = $chromosome1->getFirstIndex();
        $lastIndex = $chromosome1->getLastIndex();

        $crossOverPoint = $this->randomizer->getInteger($firstIndex, $lastIndex);
        $sequence1 = [];
        $sequence2 = [];

        for ($i = $firstIndex; $i < $crossOverPoint; $i++) {
            $sequence1[$i] = clone $chromosome1->getGene($i);
            $sequence2[$i] = clone $chromosome2->getGene($i);
        }
        for ($i = $crossOverPoint; $i <= $lastIndex; $i++) {
            $sequence1[$i] = clone $chromosome2->getGene($i);
            $sequence2[$i] = clone $chromosome1->getGene($i);
        }

        $child1 = new Chromosome($sequence1);
        $child2 = new Chromosome($sequence2);

        return [$child1, $child2];
    }

    public function runForIndividuals(IndividualInterface $individual1, IndividualInterface $individual2): array
    {
        $chromosomes = $this->run($individual1->getChromosome(), $individual2->getChromosome());
        $offspring1 = new Individual($chromosomes[0]);
        $offspring2 = new Individual($chromosomes[1]);

        return [$offspring1, $offspring2];
    }


}