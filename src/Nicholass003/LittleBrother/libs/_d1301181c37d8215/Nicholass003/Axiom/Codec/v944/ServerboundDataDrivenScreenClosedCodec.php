<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\ServerboundDataDrivenScreenClosedPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ServerboundDataDrivenScreenClosedCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerboundDataDrivenScreenClosedPacket{
        $pk = new ServerboundDataDrivenScreenClosedPacket();
        $pk->formId = LE::readUnsignedInt($in);
        $pk->closeReason = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ServerboundDataDrivenScreenClosedPacket);
        LE::writeUnsignedInt($out, $pk->formId);
        CodecHelper::writeString($out, $pk->closeReason);
    }
}