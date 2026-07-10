<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\TakeItemActorPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class TakeItemActorCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : TakeItemActorPacket{
        $pk = new TakeItemActorPacket();
        $pk->itemActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->takerActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof TakeItemActorPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->itemActorRuntimeId);
        CodecHelper::writeActorRuntimeId($out, $pk->takerActorRuntimeId);
    }
}