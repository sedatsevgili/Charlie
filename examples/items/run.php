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
$combination4 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(4, 5),
    new Item(4, 7),
    new Item(5, 9),
    new Item(3, 1),
    new Item(7, 13),
    new Item(8, 15),
    new Item(9, 17),
    new Item(10, 19)
];

$population = new \Charlie\Population\Population([
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination1)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination2)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination3)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination4))
]);

$fitnessFunction = new KnapsackFitnessFunction();

$problem = new \Charlie\Actions\Problem\Problem();
$problem->setCalculator($fitnessFunction);
$problem->setCrossOver(new \Charlie\Actions\CrossOver(new \Charlie\Randomizer\MtRandomizer()));
$problem->setMutator(new \Charlie\Actions\Mutator(new \Charlie\Randomizer\MtRandomizer()));
$problem->setSelection(new \Charlie\Actions\PairSelection());
$problem->setMaxEvolveCount(100);
$problem->setPopulation($population);

$problem->solve();

echo (string) $problem->getPopulation() . PHP_EOL;
