<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\CameraAimAssistPresetsPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CameraAimAssistPresetsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraAimAssistPresetsPacket{
        $pk = new CameraAimAssistPresetsPacket();
        $pk->categories = $codec->cameraAimAssist()->readCategories($in);
        $pk->presets = $codec->cameraAimAssist()->readPresets($in);
        $pk->operation = Byte::readUnsigned($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraAimAssistPresetsPacket);
        $codec->cameraAimAssist()->writeCategories($out, $pk->categories);
        $codec->cameraAimAssist()->writePresets($out, $pk->presets);
        Byte::writeUnsigned($out, $pk->operation);
    }
}