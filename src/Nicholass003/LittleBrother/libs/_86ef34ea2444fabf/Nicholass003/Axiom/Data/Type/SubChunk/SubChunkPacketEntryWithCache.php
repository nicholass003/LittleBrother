<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryWithCache{

    public function __construct(
        public readonly SubChunkPacketEntryCommon $base,
        public readonly int $usedBlobHash
    ){}
}