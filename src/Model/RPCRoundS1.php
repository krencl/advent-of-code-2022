<?php

namespace Krencl\AdventOfCode2022\Model;

use Krencl\AdventOfCode2022\Lists\RPC;
use Krencl\AdventOfCode2022\Lists\RPCStrategy;

class RPCRoundS1
{
	public function __construct(public RPC $opponent, public RPC $elf, public int $score = 0)
	{
		$this->score = $this->computeScore($this->elf, $this->opponent);
	}

	private function computeScore(RPC $playerA, RPC $playerB): int
	{
		if ($playerA === $playerB) {
			return $playerA->value + RPCStrategy::Draw->value;
		}

		if (
			($playerA === RPC::Rock && $playerB === RPC::Scissors) ||
			($playerA === RPC::Paper && $playerB === RPC::Rock) ||
			($playerA === RPC::Scissors && $playerB === RPC::Paper)
		) {
			return $playerA->value + RPCStrategy::Win->value;
		}

		return $playerA->value + RPCStrategy::Loss->value;
	}
}
