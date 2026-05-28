<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\BiomeDefinitionListPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeDefinitionListCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BiomeDefinitionListPacket{
        $pk = new BiomeDefinitionListPacket();
        $pk->definitionData = $codec->biome()->readDefinitionDataList($in);
        $pk->strings = $codec->biome()->readStrings($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BiomeDefinitionListPacket);
        $codec->biome()->writeDefinitionDataList($out, $pk->definitionData);
        $codec->biome()->writeStrings($out, $pk->strings);
    }
}