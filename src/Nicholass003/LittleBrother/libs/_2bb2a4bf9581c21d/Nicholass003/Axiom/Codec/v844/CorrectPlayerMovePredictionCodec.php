<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\CorrectPlayerMovePredictionPacket;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class CorrectPlayerMovePredictionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CorrectPlayerMovePredictionPacket{
        $pk = new CorrectPlayerMovePredictionPacket();
        $pk->predictionType = Byte::readUnsigned($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->delta = CodecHelper::readVec3($in);
        $pk->vehicleRotation = CodecHelper::readVec2($in);
        $pk->vehicleAngularVelocity = CodecHelper::readOptional($in, fn($i) => LE::readFloat($i));
        $pk->onGround = CodecHelper::readBool($in);
        $pk->tick = VarInt::readUnsignedLong($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CorrectPlayerMovePredictionPacket);
        Byte::writeUnsigned($out, $pk->predictionType);
        CodecHelper::writeVec3($out, $pk->position);
        CodecHelper::writeVec3($out, $pk->delta);
        CodecHelper::writeVec2($out, $pk->vehicleRotation);
        CodecHelper::writeOptional($out, $pk->vehicleAngularVelocity, fn($o, $v) => LE::writeFloat($o, $v));
        CodecHelper::writeBool($out, $pk->onGround);
        VarInt::writeUnsignedLong($out, $pk->tick);
    }
}