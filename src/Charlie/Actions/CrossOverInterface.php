<?php

namespace Charlie\Actions;

use Charlie\Chromosome\Chromosome;

interface CrossOverInterface
{

    public function run(Chromosome $chromosome1, Chromosome $chromosome2): void;

}