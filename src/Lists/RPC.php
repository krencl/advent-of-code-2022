<?php

namespace Krencl\AdventOfCode2022\Lists;

enum RPC: int
{
	case Rock = 1;
	case Paper = 2;
	case Scissors = 3;

	public static function fromRaw(string $letter): self
	{
		return match ($letter) {
			'A', 'X' => self::Rock,
			'B', 'Y' => self::Paper,
			'C', 'Z' => self::Scissors,
		};
	}

	public function getOpponentWin(): self
	{
		return match ($this) {
			self::Rock => self::Paper,
			self::Paper => self::Scissors,
			self::Scissors => self::Rock,
		};
	}

	public function getOpponentLose(): self
	{
		return match ($this) {
			self::Rock => self::Scissors,
			self::Paper => self::Rock,
			self::Scissors => self::Paper,
		};
	}
}
