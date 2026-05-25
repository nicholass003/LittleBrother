<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Structure;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Vec3;

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