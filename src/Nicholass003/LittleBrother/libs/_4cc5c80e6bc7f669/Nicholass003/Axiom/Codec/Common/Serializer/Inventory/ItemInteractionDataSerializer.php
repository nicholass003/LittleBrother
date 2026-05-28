<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\ItemInteractionData;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ItemInteractionDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private InventoryTransactionDataSerializer $transactionSerializer
    ){}

    public function transaction() : InventoryTransactionDataSerializer{ return $this->transactionSerializer; }

    public function withTransaction(InventoryTransactionDataSerializer $v) : self{ return $this->with('transactionSerializer', $v); }

    public function read(ByteBufferReader $in, CodecType $codec) : ItemInteractionData{
        $requestId = VarInt::readSignedInt($in);
        $changedSlots = [];
        if($requestId !== 0){
            $changedSlots = CodecHelper::readList($in, function(ByteBufferReader $in) : InventoryTransactionChangedSlotsHack{
                return new InventoryTransactionChangedSlotsHack(
                    Byte::readUnsigned($in),
                    CodecHelper::readList($in, fn($in) => Byte::readUnsigned($in))
                );
            });
        }
        $transactionData = $this->transactionSerializer->read($in, $codec);
        return new ItemInteractionData($requestId, $changedSlots, $transactionData);
    }

    public function write(ByteBufferWriter $out, ItemInteractionData $data, CodecType $codec) : void{
        VarInt::writeSignedInt($out, $data->requestId);
        if($data->requestId !== 0){
            CodecHelper::writeList($out, $data->requestChangedSlots, function(ByteBufferWriter $out, InventoryTransactionChangedSlotsHack $changed) : void{
                Byte::writeUnsigned($out, $changed->containerId);
                CodecHelper::writeList($out, $changed->changedSlotIndexes, fn($out, $index) => Byte::writeUnsigned($out, $index));
            });
        }
        $this->transactionSerializer->write($out, $data->transactionData, $codec);
    }
}