<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Structure;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

class StructureSettings{

    public function __construct(
        public string $paletteName,
        public bool $ignoreEntities,
        public bool $ignoreBlocks,
        public bool $allowNonTickingChunks,
        public BlockPosition $dimensions,
        public BlockPosition $offset,
        public int $lastTouchedByPlayerID,
        public int $rotation,
        public int $mirror,
        public int $animationMode,
        public float $animationSeconds,
        public float $integrityValue,
        public int $integritySeed,
        public Vec3 $pivot
    ){}
}