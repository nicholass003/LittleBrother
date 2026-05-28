<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v1001\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\InventoryTransactionDataSerializer as BaseInventoryTransactionDataSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\NetworkInventoryActionSerializer;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\MismatchTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\NormalTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\ReleaseItemTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\TransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\UseItemOnEntityTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\InventoryTransactionType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\PredictedResult;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class InventoryTransactionDataSerializer extends BaseInventoryTransactionDataSerializer{

    public function __construct(
        NetworkInventoryActionSerializer $actionSerializer
    ){
        parent::__construct($actionSerializer);
    }

    public function read(ByteBufferReader $in, CodecType $codec) : TransactionData{
        $type = $this->readTransactionType($in);
        $hasActions = CodecHelper::readBool($in);
        $actions = $hasActions ? $this->readActions($in) : [];

        return match($type){
            InventoryTransactionType::NORMAL => new NormalTransactionData($actions),
            InventoryTransactionType::MISMATCH => $this->readMismatchData($actions),
            InventoryTransactionType::USE_ITEM => $this->readUseItemData($in, $actions, $codec),
            InventoryTransactionType::USE_ITEM_ON_ENTITY => $this->readUseItemOnEntityData($in, $actions, $codec),
            InventoryTransactionType::RELEASE_ITEM => $this->readReleaseItemData($in, $actions, $codec),
            InventoryTransactionType::UNKNOWN => throw new \RuntimeException("Unknown transaction type")
        };
    }

    public function write(ByteBufferWriter $out, TransactionData $data, CodecType $codec) : void{
        $type = $this->getTransactionType($data);
        $this->writeTransactionType($out, $type);

        $actions = $this->getActions($data);
        CodecHelper::writeBool($out, !empty($actions));
        if(!empty($actions)){
            $this->writeActions($out, $actions);
        }

        match(true){
            $data instanceof NormalTransactionData => null,
            $data instanceof MismatchTransactionData => null,
            $data instanceof UseItemTransactionData => $this->writeUseItemData($out, $data, $codec),
            $data instanceof UseItemOnEntityTransactionData => $this->writeUseItemOnEntityData($out, $data, $codec),
            $data instanceof ReleaseItemTransactionData => $this->writeReleaseItemData($out, $data, $codec),
            default => throw new \InvalidArgumentException("Unknown transaction data type")
        };
    }

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function readUseItemData(ByteBufferReader $in, array $actions, CodecType $codec) : UseItemTransactionData{
        return new UseItemTransactionData(
            $actions,
            VarInt::readUnsignedInt($in),
            $this->readTriggerType($in),
            CodecHelper::readSignedBlockPosition($in),
            Byte::readSigned($in),
            VarInt::readSignedInt($in),
            CodecHelper::readNetworkItemStackDescriptor($in),
            CodecHelper::readVec3($in),
            CodecHelper::readVec3($in),
            VarInt::readUnsignedInt($in),
            $this->readPredictedResult($in),
            Byte::readUnsigned($in)
        );
    }

    protected function writeUseItemData(ByteBufferWriter $out, UseItemTransactionData $data, CodecType $codec) : void{
        VarInt::writeUnsignedInt($out, $data->actionType);
        $this->writeTriggerType($out, $data->triggerType);
        CodecHelper::writeSignedBlockPosition($out, $data->blockPosition);
        Byte::writeSigned($out, $data->face);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeNetworkItemStackDescriptor($out, $data->itemInHand);
        CodecHelper::writeVec3($out, $data->playerPosition);
        CodecHelper::writeVec3($out, $data->clickPosition);
        VarInt::writeUnsignedInt($out, $data->blockRuntimeId);
        $this->writePredictedResult($out, $data->clientInteractPrediction);
        Byte::writeUnsigned($out, $data->clientCooldownState);
    }

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function readUseItemOnEntityData(ByteBufferReader $in, array $actions, CodecType $codec) : UseItemOnEntityTransactionData{
        return new UseItemOnEntityTransactionData(
            $actions,
            CodecHelper::readActorRuntimeId($in),
            VarInt::readUnsignedInt($in),
            VarInt::readSignedInt($in),
            CodecHelper::readNetworkItemStackDescriptor($in),
            CodecHelper::readVec3($in),
            CodecHelper::readVec3($in)
        );
    }

    protected function writeUseItemOnEntityData(ByteBufferWriter $out, UseItemOnEntityTransactionData $data, CodecType $codec) : void{
        CodecHelper::writeActorRuntimeId($out, $data->actorRuntimeId);
        VarInt::writeUnsignedInt($out, $data->actionType);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeNetworkItemStackDescriptor($out, $data->itemInHand);
        CodecHelper::writeVec3($out, $data->playerPosition);
        CodecHelper::writeVec3($out, $data->clickPosition);
    }

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function readReleaseItemData(ByteBufferReader $in, array $actions, CodecType $codec) : ReleaseItemTransactionData{
        return new ReleaseItemTransactionData(
            $actions,
            VarInt::readUnsignedInt($in),
            VarInt::readSignedInt($in),
            CodecHelper::readNetworkItemStackDescriptor($in),
            CodecHelper::readVec3($in)
        );
    }

    protected function writeReleaseItemData(ByteBufferWriter $out, ReleaseItemTransactionData $data, CodecType $codec) : void{
        VarInt::writeUnsignedInt($out, $data->actionType);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeNetworkItemStackDescriptor($out, $data->itemInHand);
        CodecHelper::writeVec3($out, $data->headPosition);
    }

    protected function readPredictedResult(ByteBufferReader $in) : PredictedResult{
        $raw = Byte::readUnsigned($in);
        $result = PredictedResult::safe($raw);
        if($result === PredictedResult::UNKNOWN){
            throw new \RuntimeException("Invalid predicted result $raw");
        }
        return $result;
    }

    protected function writePredictedResult(ByteBufferWriter $out, PredictedResult $result) : void{
        Byte::writeUnsigned($out, $result->value);
    }
}