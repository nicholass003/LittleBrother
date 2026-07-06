<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v1001\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\NetworkInventoryActionSerializer as BaseNetworkInventoryActionSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\InventoryActionSourceType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class NetworkInventoryActionSerializer extends BaseNetworkInventoryActionSerializer{

    public function read(ByteBufferReader $in) : NetworkInventoryAction{
        $sourceType = $this->readSourceType($in);
        $windowId = null;
        $sourceFlags = 0;

        if(CodecHelper::readBool($in) && CodecHelper::readBool($in)){
            $windowId = Byte::readSigned($in);
        }
        if(CodecHelper::readBool($in) && CodecHelper::readBool($in)){
            $sourceFlags = VarInt::readUnsignedInt($in);
        }

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

        CodecHelper::writeBool($out, true);
        switch($action->sourceType){
            case InventoryActionSourceType::CONTAINER:
            case InventoryActionSourceType::TODO:
                CodecHelper::writeBool($out, true);
                Byte::writeSigned($out, $action->windowId);
                break;
            default:
                CodecHelper::writeBool($out, false);
                break;
        }

        CodecHelper::writeBool($out, true);
        switch($action->sourceType){
            case InventoryActionSourceType::WORLD:
                CodecHelper::writeBool($out, true);
                VarInt::writeUnsignedInt($out, $action->sourceFlags);
                break;
            default:
                CodecHelper::writeBool($out, false);
                break;
        }

        VarInt::writeUnsignedInt($out, $action->inventorySlot);
        CodecHelper::writeNetworkItemStackDescriptor($out, $action->oldItem);
        CodecHelper::writeNetworkItemStackDescriptor($out, $action->newItem);
    }
}