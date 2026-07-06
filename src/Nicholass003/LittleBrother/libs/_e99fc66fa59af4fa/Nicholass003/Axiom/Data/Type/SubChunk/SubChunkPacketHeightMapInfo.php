<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketHeightMapInfo{

    /**
     * @param list<int> $heights
     */
    public function __construct(
        public readonly array $heights
    ){}
}