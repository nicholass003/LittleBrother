<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponse;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponseContainerInfo;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponseSlotInfo;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\ItemStackResponseResult;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ItemStackResponseSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackResponse{
        $result = ItemStackResponseResult::safe(Byte::readUnsigned($in));
        $requestId = VarInt::readSignedInt($in);
        $containerInfos = [];
        if($result === ItemStackResponseResult::OK){
            $containerInfos = CodecHelper::readList($in, function(ByteBufferReader $in) use($codec) : ItemStackResponseContainerInfo{
                $containerName = $codec->inventory()->container()->read($in);
                $slots = CodecHelper::readList($in, fn(ByteBufferReader $in) => $this->readSlotInfo($in));
                return new ItemStackResponseContainerInfo($containerName, $slots);
            });
        }
        return new ItemStackResponse($result, $requestId, $containerInfos);
    }

    public function write(ByteBufferWriter $out, ItemStackResponse $response, CodecType $codec) : void{
        Byte::writeUnsigned($out, $response->result->value);
        VarInt::writeSignedInt($out, $response->requestId);
        if($response->result === ItemStackResponseResult::OK){
            CodecHelper::writeList($out, $response->containerInfos, function(ByteBufferWriter $out, ItemStackResponseContainerInfo $info) use($codec) : void{
                $codec->inventory()->container()->write($out, $info->containerName);
                CodecHelper::writeList($out, $info->slots, fn(ByteBufferWriter $out, ItemStackResponseSlotInfo $slot) => $this->writeSlotInfo($out, $slot));
            });
        }
    }

    private function readSlotInfo(ByteBufferReader $in) : ItemStackResponseSlotInfo{
        return new ItemStackResponseSlotInfo(
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            VarInt::readSignedInt($in),
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            VarInt::readSignedInt($in)
        );
    }

    private function writeSlotInfo(ByteBufferWriter $out, ItemStackResponseSlotInfo $slot) : void{
        Byte::writeUnsigned($out, $slot->slot);
        Byte::writeUnsigned($out, $slot->hotbarSlot);
        Byte::writeUnsigned($out, $slot->count);
        VarInt::writeSignedInt($out, $slot->itemStackId);
        CodecHelper::writeString($out, $slot->customName);
        CodecHelper::writeString($out, $slot->filteredCustomName);
        VarInt::writeSignedInt($out, $slot->durabilityCorrection);
    }
}