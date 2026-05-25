<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryWithCache{

    public function __construct(
        public readonly SubChunkPacketEntryCommon $base,
        public readonly int $usedBlobHash
    ){}
}