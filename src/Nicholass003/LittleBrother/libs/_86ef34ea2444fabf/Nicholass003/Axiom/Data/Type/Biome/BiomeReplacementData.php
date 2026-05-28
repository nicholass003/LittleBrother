<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Biome;

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