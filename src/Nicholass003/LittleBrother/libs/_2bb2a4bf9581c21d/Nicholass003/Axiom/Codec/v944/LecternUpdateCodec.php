<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\LecternUpdatePacket;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class LecternUpdateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LecternUpdatePacket{
        $pk = new LecternUpdatePacket();
        $pk->page = Byte::readUnsigned($in);
        $pk->totalPages = Byte::readUnsigned($in);
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LecternUpdatePacket);
        Byte::writeUnsigned($out, $pk->page);
        Byte::writeUnsigned($out, $pk->totalPages);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
    }
}