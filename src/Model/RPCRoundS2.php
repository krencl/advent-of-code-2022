<?php

namespace Krencl\AdventOfCode2022\Model;

use Krencl\AdventOfCode2022\Lists\RPC;
use Krencl\AdventOfCode2022\Lists\RPCStrategy;

class RPCRoundS2
{
	public function __construct(public RPC $opponent, public RPCStrategy $strategy, public int $score = 0)
	{
		$this->score = $this->computeScore($this->strategy, $this->opponent);
	}

	private function computeScore(RPCStrategy $strategy, RPC $opponent): int
	{
		if ($strategy === RPCStrategy::Draw) {
			return $opponent->value + RPCStrategy::Draw->value;
		}

		if ($strategy === RPCStrategy::Win) {
			return $opponent->getOpponentWin()->value + RPCStrategy::Win->value;
		}

		return $opponent->getOpponentLose()->value + RPCStrategy::Loss->value;
	}
}
