<?php

namespace Charlie\Randomizer;

interface RandomizerInterface
{

    public function getInteger(int $min, int $max): int;

}