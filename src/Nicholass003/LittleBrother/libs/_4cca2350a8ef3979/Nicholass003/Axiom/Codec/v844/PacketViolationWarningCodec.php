<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\PacketViolationWarningPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PacketViolationWarningCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PacketViolationWarningPacket{
        $pk = new PacketViolationWarningPacket();
        $pk->type = VarInt::readSignedInt($in);
        $pk->severity = VarInt::readSignedInt($in);
        $pk->packetId = VarInt::readSignedInt($in);
        $pk->context = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PacketViolationWarningPacket);
        VarInt::writeSignedInt($out, $pk->type);
        VarInt::writeSignedInt($out, $pk->severity);
        VarInt::writeSignedInt($out, $pk->packetId);
        CodecHelper::writeString($out, $pk->context);
    }
}