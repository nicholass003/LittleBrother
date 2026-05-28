<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryCommon{

    public function __construct(
        public readonly SubChunkPositionOffset $offset,
        public readonly int $requestResult,
        public readonly string $terrainData,
        public readonly ?SubChunkPacketHeightMapInfo $heightMap,
        public readonly ?SubChunkPacketHeightMapInfo $renderHeightMap
    ){}
}