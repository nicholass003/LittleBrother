<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v859;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v859\Serializer\Camera\CameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\CameraInstructionPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraInstructionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraInstructionPacket{
        $cameraInstruction = $codec->cameraInstruction();
        assert($cameraInstruction instanceof CameraInstructionSerializer);
        $pk = new CameraInstructionPacket();
        $pk->set = CodecHelper::readOptional($in, $cameraInstruction->readSetInstruction(...));
        $pk->clear = CodecHelper::readOptional($in, CodecHelper::readBool(...));
        $pk->fade = CodecHelper::readOptional($in, $cameraInstruction->readFadeInstruction(...));
        $pk->target = CodecHelper::readOptional($in, $cameraInstruction->readTargetInstruction(...));
        $pk->removeTarget = CodecHelper::readOptional($in, CodecHelper::readBool(...));
        $pk->fieldOfView = CodecHelper::readOptional($in, $cameraInstruction->readFovInstruction(...));
        $pk->spline = CodecHelper::readOptional($in, $cameraInstruction->spline()->read(...));
        $pk->attachToEntity = CodecHelper::readOptional($in, LE::readSignedLong(...));
        $pk->detachFromEntity = CodecHelper::readOptional($in, CodecHelper::readBool(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraInstructionPacket);
        $cameraInstruction = $codec->cameraInstruction();
        assert($cameraInstruction instanceof CameraInstructionSerializer);
        CodecHelper::writeOptional($out, $pk->set, $cameraInstruction->writeSetInstruction(...));
        CodecHelper::writeOptional($out, $pk->clear, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $pk->fade, $cameraInstruction->writeFadeInstruction(...));
        CodecHelper::writeOptional($out, $pk->target, $cameraInstruction->writeTargetInstruction(...));
        CodecHelper::writeOptional($out, $pk->removeTarget, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $pk->fieldOfView, $cameraInstruction->writeFovInstruction(...));
        CodecHelper::writeOptional($out, $pk->spline, $cameraInstruction->spline()->write(...));
        CodecHelper::writeOptional($out, $pk->attachToEntity, LE::writeSignedLong(...));
        CodecHelper::writeOptional($out, $pk->detachFromEntity, CodecHelper::readBool(...));
    }
}