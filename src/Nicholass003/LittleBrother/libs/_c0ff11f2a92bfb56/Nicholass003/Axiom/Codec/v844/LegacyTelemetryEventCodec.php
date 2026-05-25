<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\LegacyTelemetryEventType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LegacyTelemetryEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class LegacyTelemetryEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LegacyTelemetryEventPacket{
        $pk = new LegacyTelemetryEventPacket();
        $pk->playerRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->eventData = VarInt::readSignedInt($in);
        $pk->type = LegacyTelemetryEventType::safe(Byte::readUnsigned($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LegacyTelemetryEventPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->playerRuntimeId);
        VarInt::writeSignedInt($out, $pk->eventData);
        Byte::writeUnsigned($out, $pk->type->value);
    }
}