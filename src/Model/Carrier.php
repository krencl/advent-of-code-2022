<?php

declare(strict_types=1);

namespace Krencl\AdventOfCode2022\Model;

final class Carrier
{
    public function __construct(public array $items = [], public int $sum = 0)
    {
    }

    public function computeSum(): void
    {
        $this->sum = array_sum($this->items);
    }
}