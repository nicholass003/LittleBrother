<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\MovementEffectPacket;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class MovementEffectCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MovementEffectPacket{
        $pk = new MovementEffectPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->effectType = VarInt::readSignedInt($in);
        $pk->duration = VarInt::readSignedInt($in);
        $pk->tick = VarInt::readUnsignedLong($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MovementEffectPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        VarInt::writeSignedInt($out, $pk->effectType);
        VarInt::writeSignedInt($out, $pk->duration);
        VarInt::writeUnsignedLong($out, $pk->tick);
    }
}