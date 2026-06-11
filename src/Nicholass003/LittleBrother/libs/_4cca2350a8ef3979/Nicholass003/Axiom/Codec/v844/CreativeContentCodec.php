<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\CreativeGroupEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\CreativeItemEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\CreativeContentPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class CreativeContentCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CreativeContentPacket{
        $pk = new CreativeContentPacket();
        $groupCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $groupCount; ++$i){
            $pk->groups[] = $this->readCreativeGroupEntry($in);
        }
        $itemCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $itemCount; ++$i){
            $pk->items[] = $this->readCreativeItemEntry($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CreativeContentPacket);
        VarInt::writeUnsignedInt($out, count($pk->groups));
        foreach($pk->groups as $group){
            $this->writeCreativeGroupEntry($out, $group);
        }
        VarInt::writeUnsignedInt($out, count($pk->items));
        foreach($pk->items as $item){
            $this->writeCreativeItemEntry($out, $item);
        }
    }

    protected function readCreativeGroupEntry(ByteBufferReader $in) : CreativeGroupEntry{
        $categoryId = LE::readSignedInt($in);
        $categoryName = CodecHelper::readString($in);
        $icon = CodecHelper::readItemStackWithoutStackId($in);
        return new CreativeGroupEntry($categoryId, $categoryName, $icon);
    }

    protected function writeCreativeGroupEntry(ByteBufferWriter $out, CreativeGroupEntry $entry) : void{
        LE::writeSignedInt($out, $entry->categoryId);
        CodecHelper::writeString($out, $entry->categoryName);
        CodecHelper::writeItemStackWithoutStackId($out, $entry->icon);
    }

    protected function readCreativeItemEntry(ByteBufferReader $in) : CreativeItemEntry{
        $entryId = CodecHelper::readCreativeItemNetId($in);
        $item = CodecHelper::readItemStackWithoutStackId($in);
        $groupId = VarInt::readUnsignedInt($in);
        return new CreativeItemEntry($entryId, $item, $groupId);
    }

    protected function writeCreativeItemEntry(ByteBufferWriter $out, CreativeItemEntry $entry) : void{
        CodecHelper::writeCreativeItemNetId($out, $entry->entryId);
        CodecHelper::writeItemStackWithoutStackId($out, $entry->item);
        VarInt::writeUnsignedInt($out, $entry->groupId);
    }
}