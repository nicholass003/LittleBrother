<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryWithCache{

    public function __construct(
        public readonly SubChunkPacketEntryCommon $base,
        public readonly int $usedBlobHash
    ){}
}