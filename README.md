# Charlie Project

## Description
This project is a simple library that allows PHP developers to easily build their own applications that use Genetic Algorithms.

## Installation
To install this library, you can use composer:
```
composer require charlieproject/genetic-algorithm
```

## Usage
To use this library for your own purposes as a PHP developer, you need to:
1. Define your own Gene class that will implement the `Charlie\Gene\GeneInterface` interface.
2. Define your own FitnessFunction class that will implement the `Charlie\Fitness\CalculatorInterface` interface.
3. Define your own Selection class that will implement the `Charlie\Actions\Selection\SelectorInterface` interface.
4. Build your populations by using the `Charlie\Population\PopulationBuilder` class or by implementing the `Charlie\Population\PopulationBuilderInterface` interface.
5. Define your problem by using the `Charlie\Problem\Problem` class.
6. Run the `solve` method of the `Charlie\Problem\Problem` class.

## Example
Let's say we want to find the best possible solution for the following problem:
> We have a list of 10 items. Each item has a weight and a value. We want to find the best combination of items that will maximize the total value of the items, but the total weight of the items must not exceed 15.

First, we need to define our Gene class. In our example, a Gene will be an item from the list. Therefore, we need to create a class that will represent an item from the list. Let's call it `Item`. The `Item` class needs to implement the `Charlie\Gene\GeneInterface` interface. Here is how the `Item` class will look like:
```php
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
    
    public function set($data): \Charlie\Gene\GeneInterface
    {
        $this->setValue($data['value'] ?? 0);
        $this->setWeight($data['weight'] ?? 0);
        return $this;
    }

    public function get()
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
```

Next, we need to define our FitnessFunction class. In our example, the FitnessFunction will calculate the total value of a combination of items. Therefore, we need to create a class that will calculate the total value of a combination of items. Let's call it `KnapsackFitnessFunction`. The `KnapsackFitnessFunction` class needs to implement the `Charlie\Fitness\CalculatorInterface` interface. Here is how the `KnapsackFitnessFunction` class will look like:
```php
<?php

class KnapsackFitnessFunction implements \Charlie\Fitness\CalculatorInterface
{
    
    public function calculate(\Charlie\Chromosome\Chromosome $chromosome): int
    {
        $items = $chromosome->getData();
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
```

Now, we can solve our problem. In our example, we will run the `Problem` class. Here is how we run it:
```php
<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/KnapsackFitnessFunction.php';
require_once __DIR__ . '/Item.php';

$combination1 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(3, 5),
    new Item(4, 7),
    new Item(5, 9),
    new Item(6, 11),
    new Item(7, 13),
    new Item(8, 15),
    new Item(9, 17),
    new Item(10, 19)
];
$combination2 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(3, 5),
    new Item(4, 7),
    new Item(4, 6),
    new Item(6, 11),
    new Item(7, 13),
    new Item(18, 5),
    new Item(9, 17),
    new Item(10, 19)
];
$combination3 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(3, 5),
    new Item(4, 7),
    new Item(4, 7),
    new Item(6, 10),
    new Item(7, 13),
    new Item(8, 15),
    new Item(9, 17),
    new Item(10, 19)
];
$population = new \Charlie\Population\Population([
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination1)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination2)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination3)),
]);

$fitnessFunction = new KnapsackFitnessFunction();

$problem = new \Charlie\Actions\Problem\Problem();
$problem->setCalculator($fitnessFunction);
$problem->setCrossOver(new \Charlie\Actions\CrossOver(new \Charlie\Randomizer\MtRandomizer()));
$problem->setMutator(new \Charlie\Actions\Mutator(new \Charlie\Randomizer\MtRandomizer()));
$problem->setSelection(new \Charlie\Actions\PairSelection());
$problem->setMaxEvolveCount(100);


$problem->solve();

echo (string) $problem->getPopulation() . PHP_EOL;

```

## License
This library is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
```
MIT License
===========

SPDX short identifier: MIT

Further resources on the MIT License
-----------------------------------

 - [Choose an open source license](https://choosealicense.com/licenses/mit/)
 - [Non-assertion covenants](https://choosealicense.com/non-assertion/)
 - [TLDR Legal: MIT License](https://tldrlegal.com/license/mit-license)
 - [Wikipedia: MIT License](https://en.wikipedia.org/wiki/MIT_License)
```
