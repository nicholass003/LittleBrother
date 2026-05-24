<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketHeightMapInfo{

    /**
     * @param list<int> $heights
     */
    public function __construct(
        public readonly array $heights
    ){}
}