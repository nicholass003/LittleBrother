<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\SubChunkPacketEntryCommonSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\SubChunkPacketHeightMapInfoSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\UpdateSubChunkBlocksPacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class SubChunkSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private SubChunkPacketHeightMapInfoSerializer $heightMapSerializer,
        private SubChunkPacketEntryCommonSerializer $entryCommonSerializer,
        private UpdateSubChunkBlocksPacketEntrySerializer $blockEntrySerializer
    ){}

    public function heightMap() : SubChunkPacketHeightMapInfoSerializer{ return $this->heightMapSerializer; }
    public function entryCommon() : SubChunkPacketEntryCommonSerializer{ return $this->entryCommonSerializer; }
    public function blockEntry() : UpdateSubChunkBlocksPacketEntrySerializer{ return $this->blockEntrySerializer; }

    public function withHeightMap(SubChunkPacketHeightMapInfoSerializer $v) : self{ return $this->with('heightMapSerializer', $v); }
    public function withEntryCommon(SubChunkPacketEntryCommonSerializer $v) : self{ return $this->with('entryCommonSerializer', $v); }
    public function withBlockEntry(UpdateSubChunkBlocksPacketEntrySerializer $v) : self{ return $this->with('blockEntrySerializer', $v); }
}