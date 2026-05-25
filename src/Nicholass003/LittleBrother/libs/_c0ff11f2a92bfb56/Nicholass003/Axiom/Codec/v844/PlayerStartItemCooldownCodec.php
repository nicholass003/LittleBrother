<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerStartItemCooldownPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PlayerStartItemCooldownCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerStartItemCooldownPacket{
        $pk = new PlayerStartItemCooldownPacket();
        $pk->itemCategory = CodecHelper::readString($in);
        $pk->cooldownTicks = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerStartItemCooldownPacket);
        CodecHelper::writeString($out, $pk->itemCategory);
        VarInt::writeSignedInt($out, $pk->cooldownTicks);
    }
}