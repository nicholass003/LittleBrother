<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPacketEntryCommon{

    public function __construct(
        public readonly SubChunkPositionOffset $offset,
        public readonly int $requestResult,
        public readonly string $terrainData,
        public readonly ?SubChunkPacketHeightMapInfo $heightMap,
        public readonly ?SubChunkPacketHeightMapInfo $renderHeightMap
    ){}
}