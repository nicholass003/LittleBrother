<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\MoveActorAbsolutePacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class MoveActorAbsoluteCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MoveActorAbsolutePacket{
        $pk = new MoveActorAbsolutePacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->flags = Byte::readUnsigned($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->pitch = CodecHelper::readRotationByte($in);
        $pk->yaw = CodecHelper::readRotationByte($in);
        $pk->headYaw = CodecHelper::readRotationByte($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MoveActorAbsolutePacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        Byte::writeUnsigned($out, $pk->flags);
        CodecHelper::writeVec3($out, $pk->position);
        CodecHelper::writeRotationByte($out, $pk->pitch);
        CodecHelper::writeRotationByte($out, $pk->yaw);
        CodecHelper::writeRotationByte($out, $pk->headYaw);
    }
}