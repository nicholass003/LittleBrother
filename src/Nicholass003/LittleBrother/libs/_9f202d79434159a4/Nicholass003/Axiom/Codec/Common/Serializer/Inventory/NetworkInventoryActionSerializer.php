<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\InventoryActionSourceType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class NetworkInventoryActionSerializer implements ForkableInterface{
    use StatelessForkable;

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
            CodecHelper::readItemStackWrapper($in),
            CodecHelper::readItemStackWrapper($in)
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
        CodecHelper::writeItemStackWrapper($out, $action->oldItem);
        CodecHelper::writeItemStackWrapper($out, $action->newItem);
    }

    private function readSourceType(ByteBufferReader $in) : InventoryActionSourceType{
        $raw = VarInt::readUnsignedInt($in);
        $type = InventoryActionSourceType::safe($raw);
        if($type === InventoryActionSourceType::UNKNOWN){
            throw new \RuntimeException("Unknown inventory action source type $raw");
        }
        return $type;
    }

    private function writeSourceType(ByteBufferWriter $out, InventoryActionSourceType $type) : void{
        if($type === InventoryActionSourceType::UNKNOWN){
            throw new \InvalidArgumentException("Unknown inventory action source type");
        }
        VarInt::writeUnsignedInt($out, $type->value);
    }

    private function requireWindowId(NetworkInventoryAction $action) : int{
        return $action->windowId ?? throw new \InvalidArgumentException("Window ID required for source type " . $action->sourceType->name);
    }
}