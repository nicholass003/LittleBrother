<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\SubChunk;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\BlockPosition;

class UpdateSubChunkBlocksPacketEntry{

    public function __construct(
        public readonly BlockPosition $blockPosition,
        public readonly int $blockRuntimeId,
        public readonly int $flags,
        public readonly int $syncedUpdateType,
        public readonly int $actorUniqueId
    ){}
}