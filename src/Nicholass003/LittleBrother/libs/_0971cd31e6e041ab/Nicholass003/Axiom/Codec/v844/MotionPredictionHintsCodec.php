<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\MotionPredictionHintsPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class MotionPredictionHintsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MotionPredictionHintsPacket{
        $pk = new MotionPredictionHintsPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->motion = CodecHelper::readVec3($in);
        $pk->onGround = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MotionPredictionHintsPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeVec3($out, $pk->motion);
        CodecHelper::writeBool($out, $pk->onGround);
    }
}