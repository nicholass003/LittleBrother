<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome;

class BiomeReplacementData{

	/**
	 * @param list<int> $targetBiomes
	 */
	public function __construct(
		public readonly int $biome,
		public readonly int $dimension,
		public readonly array $targetBiomes,
		public readonly float $amount,
		public readonly int $replacementIndex
	){}
}