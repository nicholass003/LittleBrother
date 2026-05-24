<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryCommon{

    public function __construct(
        public readonly SubChunkPositionOffset $offset,
        public readonly int $requestResult,
        public readonly string $terrainData,
        public readonly ?SubChunkPacketHeightMapInfo $heightMap,
        public readonly ?SubChunkPacketHeightMapInfo $renderHeightMap
    ){}
}