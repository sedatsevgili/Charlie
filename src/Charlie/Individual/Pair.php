<?php

namespace Charlie\Individual;

final class Pair
{

    public function __construct(private readonly IndividualInterface $individual1, private readonly IndividualInterface $individual2) {}

    public function getIndividual1(): IndividualInterface
    {
        return $this->individual1;
    }

    public function getIndividual2(): IndividualInterface
    {
        return $this->individual2;
    }

    public function __toString(): string
    {
        return $this->individual1 . ' ' . $this->individual2;
    }

    /**
     * @return IndividualInterface[]
     */
    public function toArray(): array
    {
        return [$this->individual1, $this->individual2];
    }

}