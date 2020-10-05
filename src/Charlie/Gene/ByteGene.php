<?php
namespace Charlie\Gene;

class ByteGene implements GeneInterface
{
    private bool $data = false;

    public function set($data): self
    {
        $this->data = $data;
        return $this;
    }

    public function get()
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


}