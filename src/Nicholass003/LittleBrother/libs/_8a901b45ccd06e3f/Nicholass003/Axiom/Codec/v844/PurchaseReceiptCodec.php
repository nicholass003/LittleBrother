<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\PurchaseReceiptPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class PurchaseReceiptCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PurchaseReceiptPacket{
        $pk = new PurchaseReceiptPacket();
        $pk->entries = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PurchaseReceiptPacket);
        CodecHelper::writeList($out, $pk->entries, fn($out, $s) => CodecHelper::writeString($out, $s));
    }
}