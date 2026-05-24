<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type;

class SerializableVoxelCells{

    public function __construct(
		public readonly int $xSize,
		public readonly int $ySize,
		public readonly int $zSize,
		public readonly array $storage
    ){}
}