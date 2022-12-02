<?php

declare(strict_types=1);

namespace Krencl\AdventOfCode2022\Command;

use Krencl\AdventOfCode2022\Lists\RPC;
use Krencl\AdventOfCode2022\Lists\RPCStrategy;
use Krencl\AdventOfCode2022\Model\RPCRoundS1;
use Krencl\AdventOfCode2022\Model\RPCRoundS2;
use Krencl\AdventOfCode2022\Model\RPCStrategies;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('day:02')]
final class Day02Command extends BaseCommand
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
		$rounds = $this->parseRounds($this->getData('day-02.txt'));

        $scoreS1 = array_reduce($rounds->s1, fn (int $carry, RPCRoundS1 $round): int => $carry + $round->score, 0);
        $output->writeln('Total score S1: ' . $scoreS1);

        $scoreS2 = array_reduce($rounds->s2, fn (int $carry, RPCRoundS2 $round): int => $carry + $round->score, 0);
        $output->writeln('Total score S2: ' . $scoreS2);

        return self::SUCCESS;
    }

    private function parseRounds(string $rawData): RPCStrategies
    {
        $strategies = new RPCStrategies();

        foreach (explode("\n", $rawData) as $line) {
			if (empty($line)) {
				continue;
			}

            [$opponent, $elf] = explode(' ', $line);
			$strategies->s1[] = new RPCRoundS1(
				RPC::fromRaw($opponent),
				RPC::fromRaw($elf),
			);
			$strategies->s2[] = new RPCRoundS2(
				RPC::fromRaw($opponent),
				RPCStrategy::fromRaw($elf),
			);
        }

        return $strategies;
    }
}
