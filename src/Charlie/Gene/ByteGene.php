<?php
declare(strict_types=1);

namespace Charlie\Gene;

class ByteGene implements GeneInterface
{
    private bool $data = false;

    /**
     * @param mixed $data
     * @return $this
     */
    public function set(mixed $data): self
    {
        $this->data = (bool) $data;
        return $this;
    }

    public function get(): bool
    {
        return $this->data;
    }

    public function mutate(): self
    {
        $this->set(!$this->data);
        return $this;
    }

    public function __toString(): string
    {
        return $this->data ? '1' : '0';
    }

    public function isEqual(GeneInterface $gene): bool
    {
        return $this->data === $gene->get();
    }


}