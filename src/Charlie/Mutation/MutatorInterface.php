<?php

namespace Charlie\Mutation;

use Charlie\Chromosome\Chromosome;

interface MutatorInterface
{

    public function mutate(Chromosome $chromosome): Chromosome;

}