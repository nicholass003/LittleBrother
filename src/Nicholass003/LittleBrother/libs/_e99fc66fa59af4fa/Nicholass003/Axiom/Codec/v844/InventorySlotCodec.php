<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ItemStack;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\ContainerIds;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\InventorySlotPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class InventorySlotCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : InventorySlotPacket{
        $pk = new InventorySlotPacket();
        $pk->windowId = VarInt::readUnsignedInt($in);
        $pk->inventorySlot = VarInt::readUnsignedInt($in);
        $pk->containerName = $codec->inventory()->container()->read($in);
        $pk->storage = CodecHelper::readItemStackWrapper($in);
        $pk->item = CodecHelper::readItemStackWrapper($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof InventorySlotPacket);
        VarInt::writeUnsignedInt($out, $pk->windowId);
        VarInt::writeUnsignedInt($out, $pk->inventorySlot);
        $codec->inventory()->container()->write($out, $pk->containerName ?? new FullContainerName(ContainerIds::NONE->value));
        CodecHelper::writeItemStackWrapper($out, $pk->storage ?? new ItemStackWrapper(0, new ItemStack(0, 0, 0, 0, '')));
        CodecHelper::writeItemStackWrapper($out, $pk->item);
    }
}