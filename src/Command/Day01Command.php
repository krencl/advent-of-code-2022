<?php

declare(strict_types=1);

namespace Krencl\AdventOfCode2022\Command;

use Krencl\AdventOfCode2022\Model\Carrier;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('day:01')]
final class Day01Command extends BaseCommand
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $carriers = $this->parseCarriers($this->getData('day-01.txt'));
        $sorted = $this->sortBySum($carriers);

        $sum = array_sum(array_map(fn (Carrier $carrier): int => $carrier->sum, array_slice($sorted, 0, 3)));
        $output->writeln('Max calories: ' . $sorted[0]->sum);
        $output->writeln('Top 3 sum: ' . $sum);

        return self::SUCCESS;
    }

    /**
     * @param string $rawData
     * @return array<Carrier>
     */
    private function parseCarriers(string $rawData): array
    {
        $carriers = [];

        foreach (explode("\n", $rawData) as $line) {
            $carrier ??= new Carrier();

            if ($line === '') {
                $carrier->computeSum();
                $carriers[] = $carrier;
                unset($carrier);
            } else {
                $carrier->items[] = (int) $line;
            }
        }

        return $carriers;
    }

    /**
     * @param array<Carrier> $carriers
     * @return array<Carrier>
     */
    private function sortBySum(array $carriers): array
    {
        usort(
            $carriers,
            fn (Carrier $carrierA, Carrier $carrierB): int => $carrierB->sum <=> $carrierA->sum,
        );

        return $carriers;
    }
}
