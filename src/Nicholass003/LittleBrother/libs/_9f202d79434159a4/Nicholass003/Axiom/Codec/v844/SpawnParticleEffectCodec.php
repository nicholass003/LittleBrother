<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\DimensionIds;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\SpawnParticleEffectPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SpawnParticleEffectCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SpawnParticleEffectPacket{
        $pk = new SpawnParticleEffectPacket();
        $pk->dimensionId = DimensionIds::safe(Byte::readUnsigned($in));
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->particleName = CodecHelper::readString($in);
        $pk->molangVariablesJson = CodecHelper::readOptional($in, fn($i) => CodecHelper::readString($i));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SpawnParticleEffectPacket);
        Byte::writeUnsigned($out, $pk->dimensionId->value);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeVec3($out, $pk->position);
        CodecHelper::writeString($out, $pk->particleName);
        CodecHelper::writeOptional($out, $pk->molangVariablesJson, fn($o, $v) => CodecHelper::writeString($o, $v));
    }
}