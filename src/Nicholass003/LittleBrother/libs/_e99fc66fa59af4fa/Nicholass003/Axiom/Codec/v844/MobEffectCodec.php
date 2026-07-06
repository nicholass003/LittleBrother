<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\MobEffectEvent;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\MobEffectPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class MobEffectCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MobEffectPacket{
        $pk = new MobEffectPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->eventId = MobEffectEvent::safe(Byte::readUnsigned($in));
        $pk->effectId = VarInt::readSignedInt($in);
        $pk->amplifier = VarInt::readSignedInt($in);
        $pk->particles = CodecHelper::readBool($in);
        $pk->duration = VarInt::readSignedInt($in);
        $pk->tick = VarInt::readUnsignedLong($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MobEffectPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        Byte::writeUnsigned($out, $pk->eventId->value);
        VarInt::writeSignedInt($out, $pk->effectId);
        VarInt::writeSignedInt($out, $pk->amplifier);
        CodecHelper::writeBool($out, $pk->particles);
        VarInt::writeSignedInt($out, $pk->duration);
        VarInt::writeUnsignedLong($out, $pk->tick);
    }
}