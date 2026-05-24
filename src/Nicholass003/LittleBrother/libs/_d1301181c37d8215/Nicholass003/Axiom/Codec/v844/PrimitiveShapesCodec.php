<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\PrimitiveShapesPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class PrimitiveShapesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PrimitiveShapesPacket{
        $pk = new PrimitiveShapesPacket();
        $pk->shapes = CodecHelper::readList($in, fn($in) => $codec->debug()->shapeData()->read($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PrimitiveShapesPacket);
        CodecHelper::writeList($out, $pk->shapes, fn($out, $shape) => $codec->debug()->shapeData()->write($out, $shape));
    }
}