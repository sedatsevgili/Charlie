<?php
require_once __DIR__ . '/vendor/autoload.php';

$chromosome = new \Charlie\Chromosome\Chromosome([
    new \Charlie\Gene\ByteGene(),
    new \Charlie\Gene\ByteGene(),
    new \Charlie\Gene\ByteGene(),
    (new \Charlie\Gene\ByteGene())->set(true),
    (new \Charlie\Gene\ByteGene())->set(true),
    (new \Charlie\Gene\ByteGene())->set(true),
]);

dump($chromosome->__toString());
$chromosome->mutate();
dump($chromosome->__toString());