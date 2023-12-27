<?php

namespace Charlie\Individual;

final class Pair
{

    public function __construct(private readonly Individual $individual1, private readonly Individual $individual2) {}

    public function getIndividual1(): Individual
    {
        return $this->individual1;
    }

    public function getIndividual2(): Individual
    {
        return $this->individual2;
    }

    public function __toString(): string
    {
        return $this->individual1 . ' ' . $this->individual2;
    }

    public function toArray(): array
    {
        return [$this->individual1, $this->individual2];
    }

}