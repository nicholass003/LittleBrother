<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\SubChunk;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;

class UpdateSubChunkBlocksPacketEntry{

    public function __construct(
        public readonly BlockPosition $blockPosition,
        public readonly int $blockRuntimeId,
        public readonly int $flags,
        public readonly int $syncedUpdateType,
        public readonly int $actorUniqueId
    ){}
}