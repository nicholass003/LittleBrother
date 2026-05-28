<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\TrimDataPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class TrimDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : TrimDataPacket{
        $pk = new TrimDataPacket();
        $pk->trimPatterns = CodecHelper::readList($in, fn($in) => $codec->trim()->pattern()->read($in));
        $pk->trimMaterials = CodecHelper::readList($in, fn($in) => $codec->trim()->material()->read($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof TrimDataPacket);
        CodecHelper::writeList($out, $pk->trimPatterns, fn($out, $p) => $codec->trim()->pattern()->write($out, $p));
        CodecHelper::writeList($out, $pk->trimMaterials, fn($out, $m) => $codec->trim()->material()->write($out, $m));
    }
}