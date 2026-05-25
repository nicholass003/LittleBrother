<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\UpdateSoftEnumType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateSoftEnumPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class UpdateSoftEnumCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateSoftEnumPacket{
        $pk = new UpdateSoftEnumPacket();
        $pk->enumName = CodecHelper::readString($in);
        $pk->values = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        $pk->type = UpdateSoftEnumType::safe(Byte::readUnsigned($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateSoftEnumPacket);
        CodecHelper::writeString($out, $pk->enumName);
        CodecHelper::writeList($out, $pk->values, fn($out, $v) => CodecHelper::writeString($out, $v));
        Byte::writeUnsigned($out, $pk->type->value);
    }
}