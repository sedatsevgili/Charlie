<?php
declare(strict_types=1);

namespace Charlie\Gene;

interface GeneInterface
{
    public function set(mixed $data): self;

    public function get(): mixed;

    public function mutate(): self;

    public function __toString(): string;

    public function isEqual(GeneInterface $gene): bool;
}