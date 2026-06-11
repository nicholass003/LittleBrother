<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\HudElement;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\HudVisibility;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\SetHudPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetHudCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetHudPacket{
        $pk = new SetHudPacket();
        $pk->hudElements = CodecHelper::readList(
            $in,
            fn($in) => HudElement::safe(VarInt::readSignedInt($in))
        );
        $pk->visibility = HudVisibility::safe(VarInt::readSignedInt($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetHudPacket);
        CodecHelper::writeList(
            $out,
            $pk->hudElements,
            fn($out, HudElement $e) => VarInt::writeSignedInt($out, $e->value)
        );
        VarInt::writeSignedInt($out, $pk->visibility->value);
    }
}