<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\ContainerSetDataPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ContainerSetDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ContainerSetDataPacket{
        $pk = new ContainerSetDataPacket();
        $pk->windowId = Byte::readUnsigned($in);
        $pk->property = VarInt::readSignedInt($in);
        $pk->value = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ContainerSetDataPacket);
        Byte::writeUnsigned($out, $pk->windowId);
        VarInt::writeSignedInt($out, $pk->property);
        VarInt::writeSignedInt($out, $pk->value);
    }
}