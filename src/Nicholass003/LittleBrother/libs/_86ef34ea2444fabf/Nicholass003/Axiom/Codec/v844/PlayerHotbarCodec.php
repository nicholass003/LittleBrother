<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\ContainerIds;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\PlayerHotbarPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PlayerHotbarCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerHotbarPacket{
        $pk = new PlayerHotbarPacket();
        $pk->selectedHotbarSlot = VarInt::readUnsignedInt($in);
        $pk->windowId = ContainerIds::safe(Byte::readUnsigned($in));
        $pk->selectHotbarSlot = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerHotbarPacket);
        VarInt::writeUnsignedInt($out, $pk->selectedHotbarSlot);
        Byte::writeUnsigned($out, $pk->windowId->value);
        CodecHelper::writeBool($out, $pk->selectHotbarSlot);
    }
}