<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\CameraAimAssistActionType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\CameraAimAssistTargetMode;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\CameraAimAssistPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraAimAssistCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraAimAssistPacket{
        $pk = new CameraAimAssistPacket();
        $pk->presetId = CodecHelper::readString($in);
        $pk->viewAngle = CodecHelper::readVec2($in);
        $pk->distance = LE::readFloat($in);
        $pk->targetMode = CameraAimAssistTargetMode::safe(Byte::readUnsigned($in));
        $pk->actionType = CameraAimAssistActionType::safe(Byte::readUnsigned($in));
        $pk->showDebugRender = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraAimAssistPacket);
        CodecHelper::writeString($out, $pk->presetId);
        CodecHelper::writeVec2($out, $pk->viewAngle);
        LE::writeFloat($out, $pk->distance);
        Byte::writeUnsigned($out, $pk->targetMode->value);
        Byte::writeUnsigned($out, $pk->actionType->value);
        CodecHelper::writeBool($out, $pk->showDebugRender);
    }
}