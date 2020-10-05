<?php
namespace Charlie\Chromosome;

use Charlie\Gene\GeneInterface;

class Chromosome
{

    /**
     * @var GeneInterface[]
     */
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getGene(int $index): GeneInterface
    {
        return $this->data[$index];
    }

    public function setGene(int $index, GeneInterface $gene): self
    {
        $this->data[$index] = $gene;
        return $this;
    }

    public function mutate(): self
    {
        $rand = mt_rand(1, 100);
        if ($rand < 5 || true) {
            $length = count($this->data);
            $mutatedGeneCount = mt_rand(1, $length);
            $mutationStartIndex = mt_rand(0, $length - $mutatedGeneCount);
            for ($i = $mutationStartIndex; $i <= $mutationStartIndex + $mutatedGeneCount - 1; $i++) {
                $this->setGene($i, $this->getGene($i)->mutate());
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        $string = '';
        foreach ($this->data as $gene) {
            $string .= $gene->__toString();
        }
        return $string;
    }

}