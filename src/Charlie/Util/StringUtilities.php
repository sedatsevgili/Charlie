<?php

namespace Charlie\Util;

use Charlie\Chromosome\Chromosome;
use Charlie\Gene\ByteGene;
use Charlie\Individual\Individual;
use Charlie\Population\Population;

class StringUtilities
{

    public static function createByteGene(string $data): ByteGene
    {
        $booleanData = null;

        if ($data === '1') {
            $booleanData = true;
        } else if ($data === '0') {
            $booleanData = false;
        } else {
            throw new \InvalidArgumentException('Byte Genes should be constructed by only 1 and 0s');
        }
        return (new ByteGene())
            ->set($booleanData);
    }

    public static function createChromosomeWithByteGenes(string $data): Chromosome
    {
        $byteGenes = array_map(fn($data) => self::createByteGene($data), str_split($data));
        return new Chromosome($byteGenes);
    }

    public static function createIndividualWithByteGenes(string $data): Individual
    {
        return new Individual(self::createChromosomeWithByteGenes($data));
    }

    /**
     * @param array<string> $pool
     */
    public static function createPopulationWithByteGenes(array $pool): Population
    {
        $individuals = array_map(fn($data) => self::createIndividualWithByteGenes($data), $pool);
        return new Population($individuals);
    }

}