<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\LevelEventType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LevelEventPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class LevelEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LevelEventPacket{
        $pk = new LevelEventPacket();
        $pk->eventId = LevelEventType::safe(VarInt::readSignedInt($in));
        $pk->position = CodecHelper::readVec3($in);
        $pk->eventData = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LevelEventPacket);
        VarInt::writeSignedInt($out, $pk->eventId->value);
        CodecHelper::writeVec3Nullable($out, $pk->position);
        VarInt::writeSignedInt($out, $pk->eventData);
    }
}