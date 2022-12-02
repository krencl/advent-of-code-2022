<?php

namespace Krencl\AdventOfCode2022\Lists;

enum RPCStrategy: int
{
	case Loss = 0;
	case Draw = 3;
	case Win = 6;

	public static function fromRaw(string $letter): self
	{
		return match ($letter) {
			'X' => self::Loss,
			'Y' => self::Draw,
			'Z' => self::Win,
		};
	}
}
