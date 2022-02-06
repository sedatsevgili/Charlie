<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;
use Charlie\Randomizer\RandomizerInterface;

class Mutator implements MutatorInterface
{

    public function __construct(private RandomizerInterface $randomizer)
    {
    }

    public function mutate(Chromosome $chromosome): Chromosome
    {
        $rand = $this->randomizer->getInteger(1, 500);
        if ($rand > 5) {
            return $chromosome;
        }

        $clone = $chromosome->clone();
        $length = $chromosome->getLength();

        $mutatedGeneCount = $this->randomizer->getInteger(1, $length);
        $mutationStartIndex = $this->randomizer->getInteger(0, $length - $mutatedGeneCount);

        for ($i = $mutationStartIndex; $i <= $mutationStartIndex + $mutatedGeneCount - 1; $i++) {
            $chromosome->setGene($i, $clone->getGene($i)->mutate());
        }

        return $clone;
    }


}