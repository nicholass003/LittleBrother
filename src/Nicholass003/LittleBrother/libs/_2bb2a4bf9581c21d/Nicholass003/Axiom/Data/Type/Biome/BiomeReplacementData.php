<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome;

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