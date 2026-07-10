<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\LevelEventGenericPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class LevelEventGenericCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LevelEventGenericPacket{
        $pk = new LevelEventGenericPacket();
        $pk->eventId = VarInt::readSignedInt($in);
        $pk->eventData = CodecHelper::readNbt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LevelEventGenericPacket);
        VarInt::writeSignedInt($out, $pk->eventId);
        CodecHelper::writeNbt($out, $pk->eventData);
    }
}