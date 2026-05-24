<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v944\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\InventoryTransactionDataSerializer as BaseInventoryTransactionDataSerializer;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\NetworkInventoryActionSerializer;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;
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

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    protected function readUseItemData(ByteBufferReader $in, array $actions, CodecType $codec) : UseItemTransactionData{
        return new UseItemTransactionData(
            $actions,
            VarInt::readUnsignedInt($in),
            $this->readTriggerType($in),
            CodecHelper::readSignedBlockPosition($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            CodecHelper::readItemStackWrapper($in),
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
        VarInt::writeSignedInt($out, $data->face);
        VarInt::writeSignedInt($out, $data->hotbarSlot);
        CodecHelper::writeItemStackWrapper($out, $data->itemInHand);
        CodecHelper::writeVec3($out, $data->playerPosition);
        CodecHelper::writeVec3($out, $data->clickPosition);
        VarInt::writeUnsignedInt($out, $data->blockRuntimeId);
        $this->writePredictedResult($out, $data->clientInteractPrediction);
        Byte::writeUnsigned($out, $data->clientCooldownState);
    }
}