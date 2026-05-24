<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ContainerClosePacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ContainerCloseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ContainerClosePacket{
        $pk = new ContainerClosePacket();
        $pk->windowId = Byte::readUnsigned($in);
        $pk->windowType = Byte::readUnsigned($in);
        $pk->server = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ContainerClosePacket);
        Byte::writeUnsigned($out, $pk->windowId);
        Byte::writeUnsigned($out, $pk->windowType);
        CodecHelper::writeBool($out, $pk->server);
    }
}