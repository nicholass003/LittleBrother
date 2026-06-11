<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\UpdateClientInputLocksPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateClientInputLocksCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateClientInputLocksPacket{
        $pk = new UpdateClientInputLocksPacket();
        $pk->flags = VarInt::readUnsignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateClientInputLocksPacket);
        VarInt::writeUnsignedInt($out, $pk->flags);
    }
}