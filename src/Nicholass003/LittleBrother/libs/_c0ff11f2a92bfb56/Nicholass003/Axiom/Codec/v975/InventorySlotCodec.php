<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\InventorySlotPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class InventorySlotCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : InventorySlotPacket{
        $pk = new InventorySlotPacket();
        $pk->windowId = VarInt::readUnsignedInt($in);
        $pk->inventorySlot = VarInt::readUnsignedInt($in);
        $pk->containerName = CodecHelper::readOptional($in, $codec->inventory()->container()->read(...));
        $pk->storage = CodecHelper::readOptional($in, CodecHelper::readNetworkItemStackDescriptor(...));
        $pk->item = CodecHelper::readNetworkItemStackDescriptor($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof InventorySlotPacket);
        VarInt::writeUnsignedInt($out, $pk->windowId);
        VarInt::writeUnsignedInt($out, $pk->inventorySlot);
        CodecHelper::writeOptional($out, $pk->containerName, $codec->inventory()->container()->write(...));
        CodecHelper::writeOptional($out, $pk->storage, CodecHelper::writeNetworkItemStackDescriptor(...));
        CodecHelper::writeItemStackWrapper($out, $pk->item);
    }
}