<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\CompletedUsingItemPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CompletedUsingItemCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CompletedUsingItemPacket{
        $pk = new CompletedUsingItemPacket();
        $pk->itemId = LE::readSignedShort($in);
        $pk->action = LE::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CompletedUsingItemPacket);
        LE::writeSignedShort($out, $pk->itemId);
        LE::writeSignedInt($out, $pk->action);
    }
}