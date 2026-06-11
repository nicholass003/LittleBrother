<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\PartyDestinationCookieIntent;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\SendPartyDestinationCookiePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SendPartyDestinationCookieCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : Packet{
        $pk = new SendPartyDestinationCookiePacket();
        $pk->cookie = CodecHelper::readString($in);
        $pk->intent = PartyDestinationCookieIntent::safe(CodecHelper::readString($in));
        $pk->destinationName = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SendPartyDestinationCookiePacket);
        CodecHelper::writeString($out, $pk->cookie);
        CodecHelper::writeString($out, $pk->intent->value);
        CodecHelper::writeString($out, $pk->destinationName);
    }
}