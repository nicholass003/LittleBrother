<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BlockEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class BlockEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BlockEventPacket{
        $pk = new BlockEventPacket();
        $pk->blockPosition = CodecHelper::readBlockPosition($in);
        $pk->eventType = VarInt::readSignedInt($in);
        $pk->eventData = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BlockEventPacket);
        CodecHelper::writeBlockPosition($out, $pk->blockPosition);
        VarInt::writeSignedInt($out, $pk->eventType);
        VarInt::writeSignedInt($out, $pk->eventData);
    }
}