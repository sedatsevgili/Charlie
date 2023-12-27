<?php
require_once __DIR__ . '/vendor/autoload.php';

$population = \Charlie\Util\StringUtilities::createPopulationWithByteGenes([
    '000000000',
    '000100000',
    '001000000',
    '011000000',
    '000100000',
    '001000000',
    '011001000',
    '000100000',
    '001001000',
    '011001000',
    '000100000',
    '001001000',
    '011000000',
    '000100100',
    '001010000',
    '011010000',
]);

$randomizer = new \Charlie\Randomizer\MtRandomizer();

$problem = new \Charlie\Actions\Problem\Problem();
$problem->setCalculator(new \Charlie\Fitness\DummySumCalculator());
$problem->setCrossOver(new \Charlie\Actions\CrossOver($randomizer));
$problem->setMutator(new \Charlie\Actions\Mutator($randomizer));
$problem->setSelection(new \Charlie\Actions\PairSelection());
$problem->setPopulation($population);
$problem->setMaxEvolveCount(100);

$problem->solve();

echo (string) $problem->getPopulation() . PHP_EOL;