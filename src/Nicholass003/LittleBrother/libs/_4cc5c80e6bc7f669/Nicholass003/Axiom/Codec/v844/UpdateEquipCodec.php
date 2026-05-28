<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\UpdateEquipPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateEquipCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateEquipPacket{
        $pk = new UpdateEquipPacket();
        $pk->windowId = Byte::readUnsigned($in);
        $pk->windowType = Byte::readUnsigned($in);
        $pk->windowSlotCount = VarInt::readSignedInt($in);
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->nbt = CodecHelper::readNbt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateEquipPacket);
        Byte::writeUnsigned($out, $pk->windowId);
        Byte::writeUnsigned($out, $pk->windowType);
        VarInt::writeSignedInt($out, $pk->windowSlotCount);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeNbt($out, $pk->nbt);
    }
}