<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\PartyDestinationCookieResponsePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class PartyDestinationCookieResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : Packet{
        $pk = new PartyDestinationCookieResponsePacket();
        $pk->cookie = CodecHelper::readString($in);
        $pk->accepted = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PartyDestinationCookieResponsePacket);
        CodecHelper::writeString($out, $pk->cookie);
        CodecHelper::writeBool($out, $pk->accepted);
    }
}