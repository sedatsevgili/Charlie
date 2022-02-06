<?php

namespace Charlie\Randomizer;

class MtRandomizer implements RandomizerInterface
{

    public function getInteger(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }

}