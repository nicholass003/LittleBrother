<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

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