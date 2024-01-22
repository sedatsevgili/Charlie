<?php

class KnapsackFitnessFunction implements \Charlie\Fitness\CalculatorInterface
{

    public function calculate(\Charlie\Chromosome\Chromosome $chromosome): int
    {
        $items = $chromosome->getData();
        $items = array_filter($items, function (Item $item) {
            return $item->isPicked();
        });
        $totalValue = array_reduce($items, function ($carry, $item) {
            return $carry + $item->getValue();
        }, 0);
        $totalWeight = array_reduce($items, function ($carry, $item) {
            return $carry + $item->getWeight();
        }, 0);
        if ($totalWeight > 15) {
            $totalValue = 0;
        }

        return $totalValue;
    }

}