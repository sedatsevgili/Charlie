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
];
$combination2 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(3, 5),
    new Item(4, 7),
    new Item(4, 6),
    new Item(6, 11),
    new Item(7, 13),
];
$combination3 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(3, 5),
    new Item(4, 7),
    new Item(4, 7),
    new Item(6, 10),
    new Item(7, 13),
];
$combination4 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(4, 5),
    new Item(4, 7),
    new Item(5, 9),
    new Item(3, 1),
    new Item(7, 13),
];
$combination5 = [
    new Item(1, 1),
    new Item(2, 3),
    new Item(4, 5),
    new Item(6, 7),
    new Item(5, 9),
    new Item(3, 10),
    new Item(7, 13),
];

$population = new \Charlie\Population\Population([
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination1)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination2)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination3)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination4)),
    new \Charlie\Individual\Individual(new \Charlie\Chromosome\Chromosome($combination5)),
]);

$fitnessFunction = new KnapsackFitnessFunction();
$selection = new \Charlie\Actions\PairSelection();

$problem = new \Charlie\Actions\Problem\Problem();
$problem->setCalculator($fitnessFunction);
$problem->setCrossOver(new \Charlie\Actions\CrossOver(new \Charlie\Randomizer\MtRandomizer()));
$problem->setMutator(new \Charlie\Actions\Mutator(new \Charlie\Randomizer\MtRandomizer()));
$problem->setSelection($selection);
$problem->setMaxEvolveCount(100);
$problem->setPopulation($population);

$problem->solve();

echo "SOLUTION: " . PHP_EOL;
$bestParents = $selection->selectBest($population, $fitnessFunction);
echo (string) $bestParents->getIndividual1() . PHP_EOL;
