<?php

declare(strict_types=1);

namespace Krencl\AdventOfCode2022\Command;

use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command
{
    protected function getData(string $name): string
    {
        return file_get_contents(__DIR__ . '/../../data/' . $name);
    }
}