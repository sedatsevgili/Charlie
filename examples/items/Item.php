<?php

class Item implements \Charlie\Gene\GeneInterface
{

    private $weight;
    private $value;

    public function __construct(int $weight, int $value)
    {
        $this->weight = $weight;
        $this->value = $value;
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
        $this->setValue($this->getValue() + mt_rand(-1, 1));
        $this->setWeight($this->getWeight() + mt_rand(-1, 1));
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('Item: %s, %s', $this->getValue(), $this->getWeight());
    }

    public function isEqual(\Charlie\Gene\GeneInterface $gene): bool
    {
        return $this->getValue() === $gene->getValue() && $this->getWeight() === $gene->getWeight();
    }


}