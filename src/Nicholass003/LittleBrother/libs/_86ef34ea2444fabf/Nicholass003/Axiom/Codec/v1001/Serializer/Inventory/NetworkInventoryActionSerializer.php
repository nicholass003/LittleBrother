<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v1001\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\NetworkInventoryActionSerializer as BaseNetworkInventoryActionSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\InventoryActionSourceType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class NetworkInventoryActionSerializer extends BaseNetworkInventoryActionSerializer{

    public function read(ByteBufferReader $in) : NetworkInventoryAction{
        $sourceType = $this->readSourceType($in);
        $windowId = null;
        $sourceFlags = 0;

        match($sourceType){
            InventoryActionSourceType::CONTAINER => $windowId = VarInt::readSignedInt($in),
            InventoryActionSourceType::WORLD => $sourceFlags = VarInt::readUnsignedInt($in),
            InventoryActionSourceType::CREATIVE => null,
            InventoryActionSourceType::TODO => $windowId = VarInt::readSignedInt($in),
            InventoryActionSourceType::UNKNOWN => throw new \RuntimeException("Unknown inventory action source type")
        };

        return new NetworkInventoryAction(
            $sourceType,
            $windowId,
            $sourceFlags,
            VarInt::readUnsignedInt($in),
            CodecHelper::readNetworkItemStackDescriptor($in),
            CodecHelper::readNetworkItemStackDescriptor($in)
        );
    }

    public function write(ByteBufferWriter $out, NetworkInventoryAction $action) : void{
        $this->writeSourceType($out, $action->sourceType);

        match($action->sourceType){
            InventoryActionSourceType::CONTAINER => VarInt::writeSignedInt($out, $this->requireWindowId($action)),
            InventoryActionSourceType::WORLD => VarInt::writeUnsignedInt($out, $action->sourceFlags),
            InventoryActionSourceType::CREATIVE => null,
            InventoryActionSourceType::TODO => VarInt::writeSignedInt($out, $this->requireWindowId($action)),
            InventoryActionSourceType::UNKNOWN => throw new \InvalidArgumentException("Unknown inventory action source type")
        };

        VarInt::writeUnsignedInt($out, $action->inventorySlot);
        CodecHelper::writeNetworkItemStackDescriptor($out, $action->oldItem);
        CodecHelper::writeNetworkItemStackDescriptor($out, $action->newItem);
    }
}