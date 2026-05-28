<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\MismatchTransactionData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\NormalTransactionData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\ReleaseItemTransactionData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\TransactionData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\UseItemOnEntityTransactionData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\InventoryTransactionType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\PredictedResult;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\TriggerType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class InventoryTransactionDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        protected NetworkInventoryActionSerializer $actionSerializer
    ){}

    public function action() : NetworkInventoryActionSerializer{ return $this->actionSerializer; }

    public function withAction(NetworkInventoryActionSerializer $v) : self{ return $this->with('actionSerializer', $v); }

    public function read(ByteBufferReader $in, CodecType $codec) : TransactionData{
        $type = $this->readTransactionType($in);
        $actions = $this->readActions($in);

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
        $this->writeActions($out, $this->getActions($data));

        match(true){
            $data instanceof NormalTransactionData => null,
            $data instanceof MismatchTransactionData => null,
            $data instanceof UseItemTransactionData => $this->writeUseItemData($out, $data, $codec),
            $data instanceof UseItemOnEntityTransactionData => $this->writeUseItemOnEntityData($out, $data, $codec),
            $data instanceof ReleaseItemTransactionData => $this->writeReleaseItemData($out, $data, $codec),
            default => throw new \InvalidArgumentException("Unknown transaction data type")
        };
    }

    protected function readTransactionType(ByteBufferReader $in) : InventoryTransactionType{
        $raw = VarInt::readUnsignedInt($in);
        $type = InventoryTransactionType::safe($raw);
        if($type === InventoryTransactionType::UNKNOWN){
            throw new \RuntimeException("Unknown transaction type $raw");
        }
        return $type;
    }

    protected function writeTransactionType(ByteBufferWriter $out, InventoryTransactionType $type) : void{
        VarInt::writeUnsignedInt($out, $type->value);
    }

    protected function getTransactionType(TransactionData $data) : InventoryTransactionType{
        return match(true){
            $data instanceof NormalTransactionData => InventoryTransactionType::NORMAL,
            $data instanceof MismatchTransactionData => InventoryTransactionType::MISMATCH,
            $data instanceof UseItemTransactionData => InventoryTransactionType::USE_ITEM,
            $data instanceof UseItemOnEntityTransactionData => InventoryTransactionType::USE_ITEM_ON_ENTITY,
            $data instanceof ReleaseItemTransactionData => InventoryTransactionType::RELEASE_ITEM,
            default => throw new \InvalidArgumentException("Unknown transaction data")
        };
    }

    /**
     * @return list<NetworkInventoryAction>
     */
    protected function readActions(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->actionSerializer->read($in));
    }

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function writeActions(ByteBufferWriter $out, array $actions) : void{
        CodecHelper::writeList($out, $actions, fn($out, $a) => $this->actionSerializer->write($out, $a));
    }

    /**
     * @return list<NetworkInventoryAction>
     */
    protected function getActions(TransactionData $data) : array{
        return match(true){
            $data instanceof NormalTransactionData => $data->actions,
            $data instanceof MismatchTransactionData => $data->actions,
            $data instanceof UseItemTransactionData => $data->actions,
            $data instanceof UseItemOnEntityTransactionData => $data->actions,
            $data instanceof ReleaseItemTransactionData => $data->actions,
            default => throw new \InvalidArgumentException("Unknown transaction data")
        };
    }

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function readMismatchData(array $actions) : MismatchTransactionData{
        if(count($actions) > 0){
            throw new \RuntimeException("Mismatch transaction should not have actions");
        }
        return new MismatchTransactionData();
    }

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function readUseItemData(ByteBufferReader $in, array $actions, CodecType $codec) : UseItemTransactionData{
        return new UseItemTransactionData(
            $actions,
            VarInt::readUnsignedInt($in),
            $this->readTriggerType($in),
            CodecHelper::readBlockPosition($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            CodecHelper::readItemStackWrapper($in),
            CodecHelper::readVec3($in),
            CodecHelper::readVec3($in),
            VarInt::readUnsignedInt($in),
            $this->readPredictedResult($in)
        );
    }

    protected function writeUseItemData(ByteBufferWriter $out, UseItemTransactionData $data, CodecType $codec) : void{
        VarInt::writeUnsignedInt($out, $data->actionType);
        $this->writeTriggerType($out, $data->triggerType);
        CodecHelper::writeBlockPosition($out, $data->blockPosition);
        VarInt::writeSignedInt($out, $data->face);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeItemStackWrapper($out, $data->itemInHand);
        CodecHelper::writeVec3($out, $data->playerPosition);
        CodecHelper::writeVec3($out, $data->clickPosition);
        VarInt::writeUnsignedInt($out, $data->blockRuntimeId);
        $this->writePredictedResult($out, $data->clientInteractPrediction);
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
            CodecHelper::readItemStackWrapper($in),
            CodecHelper::readVec3($in),
            CodecHelper::readVec3($in)
        );
    }

    protected function writeUseItemOnEntityData(ByteBufferWriter $out, UseItemOnEntityTransactionData $data, CodecType $codec) : void{
        CodecHelper::writeActorRuntimeId($out, $data->actorRuntimeId);
        VarInt::writeUnsignedInt($out, $data->actionType);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeItemStackWrapper($out, $data->itemInHand);
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
            CodecHelper::readItemStackWrapper($in),
            CodecHelper::readVec3($in)
        );
    }

    protected function writeReleaseItemData(ByteBufferWriter $out, ReleaseItemTransactionData $data, CodecType $codec) : void{
        VarInt::writeUnsignedInt($out, $data->actionType);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeItemStackWrapper($out, $data->itemInHand);
        CodecHelper::writeVec3($out, $data->headPosition);
    }

    protected function readTriggerType(ByteBufferReader $in) : TriggerType{
        $raw = VarInt::readUnsignedInt($in);
        $type = TriggerType::safe($raw);
        if($type === TriggerType::INVALID){
            throw new \RuntimeException("Invalid trigger type $raw");
        }
        return $type;
    }

    protected function writeTriggerType(ByteBufferWriter $out, TriggerType $type) : void{
        VarInt::writeUnsignedInt($out, $type->value);
    }

    protected function readPredictedResult(ByteBufferReader $in) : PredictedResult{
        $raw = VarInt::readUnsignedInt($in);
        $result = PredictedResult::safe($raw);
        if($result === PredictedResult::UNKNOWN){
            throw new \RuntimeException("Invalid predicted result $raw");
        }
        return $result;
    }

    protected function writePredictedResult(ByteBufferWriter $out, PredictedResult $result) : void{
        VarInt::writeUnsignedInt($out, $result->value);
    }
}