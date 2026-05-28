<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\ModalFormResponsePacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ModalFormResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ModalFormResponsePacket{
        $pk = new ModalFormResponsePacket();
        $pk->formId = VarInt::readUnsignedInt($in);
        $pk->formData = CodecHelper::readOptional($in, fn($i) => CodecHelper::readString($i));
        $pk->cancelReason = CodecHelper::readOptional($in, fn($i) => Byte::readUnsigned($i));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ModalFormResponsePacket);
        VarInt::writeUnsignedInt($out, $pk->formId);
        CodecHelper::writeOptional($out, $pk->formData, fn($o, $v) => CodecHelper::writeString($o, $v));
        CodecHelper::writeOptional($out, $pk->cancelReason, fn($o, $v) => Byte::writeUnsigned($o, $v));
    }
}