<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\ActorEventType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\ActorEventPacket;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ActorEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ActorEventPacket{
        $pk = new ActorEventPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->eventId = ActorEventType::safe(Byte::readUnsigned($in));
        $pk->eventData = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ActorEventPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        Byte::writeUnsigned($out, $pk->eventId->value);
        VarInt::writeSignedInt($out, $pk->eventData);
    }
}