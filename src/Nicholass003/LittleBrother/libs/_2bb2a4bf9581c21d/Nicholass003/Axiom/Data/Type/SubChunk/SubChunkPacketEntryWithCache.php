<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryWithCache{

    public function __construct(
        public readonly SubChunkPacketEntryCommon $base,
        public readonly int $usedBlobHash
    ){}
}