<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponse;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponseContainerInfo;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponseSlotInfo;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ItemStackResponseResult;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ItemStackResponsePacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ItemStackResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ItemStackResponsePacket{
        $pk = new ItemStackResponsePacket();
        $pk->responses = CodecHelper::readList($in, fn(ByteBufferReader $in) => $this->readItemStackResponse($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ItemStackResponsePacket);
        CodecHelper::writeList($out, $pk->responses, function(ByteBufferWriter $out, ItemStackResponse $response) : void{
            $this->writeItemStackResponse($out, $response);
        });
    }

    protected function readItemStackResponse(ByteBufferReader $in) : ItemStackResponse{
        $result = ItemStackResponseResult::safe(Byte::readUnsigned($in));
        $requestId = $this->readItemStackRequestId($in);
        $containerInfos = [];
        if($result === ItemStackResponseResult::OK){
            $containerInfos = CodecHelper::readList($in, fn(ByteBufferReader $in) => $this->readContainerInfo($in));
        }
        return new ItemStackResponse($result, $requestId, $containerInfos);
    }

    protected function writeItemStackResponse(ByteBufferWriter $out, ItemStackResponse $response) : void{
        Byte::writeUnsigned($out, $response->result->value);
        $this->writeItemStackRequestId($out, $response->requestId);
        if($response->result === ItemStackResponseResult::OK){
            CodecHelper::writeList($out, $response->containerInfos, function(ByteBufferWriter $out, ItemStackResponseContainerInfo $info) : void{
                $this->writeContainerInfo($out, $info);
            });
        }
    }

    protected function readItemStackRequestId(ByteBufferReader $in) : int{
        return VarInt::readSignedInt($in);
    }

    protected function writeItemStackRequestId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeSignedInt($out, $id);
    }

    protected function readContainerInfo(ByteBufferReader $in) : ItemStackResponseContainerInfo{
        $containerName = $this->readFullContainerName($in);
        $slots = CodecHelper::readList($in, fn(ByteBufferReader $in) => $this->readSlotInfo($in));
        return new ItemStackResponseContainerInfo($containerName, $slots);
    }

    protected function writeContainerInfo(ByteBufferWriter $out, ItemStackResponseContainerInfo $info) : void{
        $this->writeFullContainerName($out, $info->containerName);
        CodecHelper::writeList($out, $info->slots, function(ByteBufferWriter $out, ItemStackResponseSlotInfo $slot) : void{
            $this->writeSlotInfo($out, $slot);
        });
    }

    protected function readSlotInfo(ByteBufferReader $in) : ItemStackResponseSlotInfo{
        return new ItemStackResponseSlotInfo(
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            Byte::readUnsigned($in),
            $this->readServerItemStackId($in),
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            VarInt::readSignedInt($in)
        );
    }

    protected function writeSlotInfo(ByteBufferWriter $out, ItemStackResponseSlotInfo $slot) : void{
        Byte::writeUnsigned($out, $slot->slot);
        Byte::writeUnsigned($out, $slot->hotbarSlot);
        Byte::writeUnsigned($out, $slot->count);
        $this->writeServerItemStackId($out, $slot->itemStackId);
        CodecHelper::writeString($out, $slot->customName);
        CodecHelper::writeString($out, $slot->filteredCustomName);
        VarInt::writeSignedInt($out, $slot->durabilityCorrection);
    }

    protected function readFullContainerName(ByteBufferReader $in) : FullContainerName{
        $containerId = Byte::readUnsigned($in);
        $dynamicId = CodecHelper::readOptional($in, fn(ByteBufferReader $in) => VarInt::readSignedInt($in));
        return new FullContainerName($containerId, $dynamicId);
    }

    protected function writeFullContainerName(ByteBufferWriter $out, FullContainerName $name) : void{
        Byte::writeUnsigned($out, $name->containerId);
        CodecHelper::writeOptional($out, $name->dynamicId, fn(ByteBufferWriter $out, int $v) => VarInt::writeSignedInt($out, $v));
    }

    protected function readServerItemStackId(ByteBufferReader $in) : int{
        return VarInt::readSignedInt($in);
    }

    protected function writeServerItemStackId(ByteBufferWriter $out, int $id) : void{
        VarInt::writeSignedInt($out, $id);
    }
}