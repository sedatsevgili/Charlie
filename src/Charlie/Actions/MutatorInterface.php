<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;

interface MutatorInterface
{

    public function mutate(Chromosome $chromosome): Chromosome;

}