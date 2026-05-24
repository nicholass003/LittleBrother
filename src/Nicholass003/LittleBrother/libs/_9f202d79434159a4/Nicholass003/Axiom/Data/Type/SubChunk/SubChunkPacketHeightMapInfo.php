<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketHeightMapInfo{

    /**
     * @param list<int> $heights
     */
    public function __construct(
        public readonly array $heights
    ){}
}