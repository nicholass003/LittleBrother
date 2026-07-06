<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketHeightMapInfo{

    /**
     * @param list<int> $heights
     */
    public function __construct(
        public readonly array $heights
    ){}
}