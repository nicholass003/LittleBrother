<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\LecternUpdatePacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class LecternUpdateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LecternUpdatePacket{
        $pk = new LecternUpdatePacket();
        $pk->page = Byte::readUnsigned($in);
        $pk->totalPages = Byte::readUnsigned($in);
        $pk->blockPosition = CodecHelper::readBlockPosition($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LecternUpdatePacket);
        Byte::writeUnsigned($out, $pk->page);
        Byte::writeUnsigned($out, $pk->totalPages);
        CodecHelper::writeBlockPosition($out, $pk->blockPosition);
    }
}