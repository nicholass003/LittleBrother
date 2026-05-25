<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AnvilDamagePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class AnvilDamageCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AnvilDamagePacket{
        $pk = new AnvilDamagePacket();
        $pk->damageAmount = Byte::readUnsigned($in);
        $pk->blockPosition = CodecHelper::readBlockPosition($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AnvilDamagePacket);
        Byte::writeUnsigned($out, $pk->damageAmount);
        CodecHelper::writeBlockPosition($out, $pk->blockPosition);
    }
}