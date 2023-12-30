<?php
declare(strict_types=1);

namespace Charlie\Chromosome;

use Charlie\Exceptions\GeneNotFoundException;
use Charlie\Gene\GeneInterface;

class Chromosome
{

    /** @param GeneInterface[] $data */
    public function __construct(private array $data)
    {
    }

    /**
     * @return GeneInterface[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getGene(int $index): GeneInterface
    {
        if (!isset($this->data[$index])) {
            throw new GeneNotFoundException(sprintf('Gene not found in this index: %s', (string)$index));
        }
        return $this->data[$index];
    }

    public function setGene(int $index, GeneInterface $gene): self
    {
        $this->data[$index] = $gene;
        return $this;
    }

    public function getLength(): int
    {
        return count($this->data);
    }

    public function __toString(): string
    {
        $string = '';
        foreach ($this->data as $gene) {
            $string .= $gene->__toString();
        }
        return $string;
    }

    public function clone(): self
    {
        return new Chromosome($this->getData());
    }

    public function getFirstIndex(): int
    {
        return min(array_keys($this->data));
    }

    public function getLastIndex(): int
    {
        return max(array_keys($this->data));
    }

    public function isEqual(Chromosome $chromosome): bool
    {
        if ($this->getLength() !== $chromosome->getLength()) {
            return false;
        }

        foreach ($this->data as $index => $gene) {
            if (! $gene->isEqual($chromosome->getGene($index))) {
                return false;
            }
        }

        return true;

    }

    public function copyFrom(Chromosome $chromosome): void
    {
        $this->data = $chromosome->getData();
    }

    public function copyGeneFrom(Chromosome $chromosome, int $index): void
    {
        $this->data[$index] = clone $chromosome->getGene($index);
    }

}