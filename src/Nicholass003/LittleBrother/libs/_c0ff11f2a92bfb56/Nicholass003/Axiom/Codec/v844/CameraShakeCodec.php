<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\CameraShakeAction;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\CameraShakeType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraShakePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraShakeCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraShakePacket{
        $pk = new CameraShakePacket();
        $pk->intensity = LE::readFloat($in);
        $pk->duration = LE::readFloat($in);
        $pk->shakeType = CameraShakeType::safe(Byte::readUnsigned($in));
        $pk->shakeAction = CameraShakeAction::safe(Byte::readUnsigned($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraShakePacket);
        LE::writeFloat($out, $pk->intensity);
        LE::writeFloat($out, $pk->duration);
        Byte::writeUnsigned($out, $pk->shakeType->value);
        Byte::writeUnsigned($out, $pk->shakeAction->value);
    }
}