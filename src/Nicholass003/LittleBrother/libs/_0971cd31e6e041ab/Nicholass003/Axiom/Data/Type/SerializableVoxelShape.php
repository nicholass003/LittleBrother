<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class SerializableVoxelShape{

	/**
	 * @param list<SerializableVoxelCells> $cells
	 * @param list<float> $xCoordinates
	 * @param list<float> $yCoordinates
	 * @param list<float> $zCoordinates
	 */
    public function __construct(
		public readonly array $cells,
		public readonly array $xCoordinates,
		public readonly array $yCoordinates,
		public readonly array $zCoordinates
    ){}
}