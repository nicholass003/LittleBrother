<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\CameraAimAssistActionType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ClientCameraAimAssistPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ClientCameraAimAssistCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientCameraAimAssistPacket{
        $pk = new ClientCameraAimAssistPacket();
        $pk->presetId = CodecHelper::readString($in);
        $pk->actionType = CameraAimAssistActionType::safe(Byte::readUnsigned($in));
        $pk->allowAimAssist = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientCameraAimAssistPacket);
        CodecHelper::writeString($out, $pk->presetId);
        Byte::writeUnsigned($out, $pk->actionType->value);
        CodecHelper::writeBool($out, $pk->allowAimAssist);
    }
}