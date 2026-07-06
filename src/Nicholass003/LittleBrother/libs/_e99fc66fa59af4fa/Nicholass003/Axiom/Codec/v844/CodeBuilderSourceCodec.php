<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\CodeBuilderSourcePacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CodeBuilderSourceCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CodeBuilderSourcePacket{
        $pk = new CodeBuilderSourcePacket();
        $pk->operation = Byte::readUnsigned($in);
        $pk->category = Byte::readUnsigned($in);
        $pk->codeStatus = Byte::readUnsigned($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CodeBuilderSourcePacket);
        Byte::writeUnsigned($out, $pk->operation);
        Byte::writeUnsigned($out, $pk->category);
        Byte::writeUnsigned($out, $pk->codeStatus);
    }
}