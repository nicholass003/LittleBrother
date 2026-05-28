<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\ArmorSlot;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\HurtArmorPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class HurtArmorCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : HurtArmorPacket{
        $pk = new HurtArmorPacket();
        $pk->cause = VarInt::readSignedInt($in);
        $pk->health = VarInt::readSignedInt($in);
        $pk->armorSlotFlags = ArmorSlot::safe(VarInt::readUnsignedLong($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof HurtArmorPacket);
        VarInt::writeSignedInt($out, $pk->cause);
        VarInt::writeSignedInt($out, $pk->health);
        VarInt::writeUnsignedLong($out, $pk->armorSlotFlags->value);
    }
}