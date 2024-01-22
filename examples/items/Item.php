<?php

class Item implements \Charlie\Gene\GeneInterface
{

    private bool $picked;

    public function __construct(private int $weight, private int $value)
    {
        $this->weight = $weight;
        $this->value = $value;
        $this->picked = false;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function isPicked(): bool
    {
        return $this->picked;
    }

    public function set(mixed $data): \Charlie\Gene\GeneInterface
    {
        $this->setValue($data['value'] ?? 0);
        $this->setWeight($data['weight'] ?? 0);
        return $this;
    }

    public function get(): mixed
    {
        return [
            'value' => $this->getValue(),
            'weight' => $this->getWeight(),
        ];
    }

    public function mutate(): \Charlie\Gene\GeneInterface
    {
        $this->picked = !$this->picked;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('Value: %s, Weight: %s, Picked: %s', $this->getValue(), $this->getWeight(), $this->isPicked() ? 'Yes' : 'No');
    }

    public function isEqual(\Charlie\Gene\GeneInterface $gene): bool
    {
        return $this->getValue() === $gene->getValue() && $this->getWeight() === $gene->getWeight();
    }


}