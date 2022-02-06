<?php
declare(strict_types=1);

namespace Charlie\Gene;

interface GeneInterface
{
    public function set($data): self;

    public function get();

    public function mutate(): self;

    public function __toString(): string;
}