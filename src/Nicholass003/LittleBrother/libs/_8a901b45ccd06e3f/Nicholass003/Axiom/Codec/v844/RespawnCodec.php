<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\RespawnPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class RespawnCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : RespawnPacket{
        $pk = new RespawnPacket();
        $pk->position = CodecHelper::readVec3($in);
        $pk->respawnState = Byte::readUnsigned($in);
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof RespawnPacket);
        CodecHelper::writeVec3($out, $pk->position);
        Byte::writeUnsigned($out, $pk->respawnState);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
    }
}