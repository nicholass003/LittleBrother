<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ItemTypeEntry;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\ItemRegistryPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ItemRegistryCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ItemRegistryPacket{
        $pk = new ItemRegistryPacket();
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $stringId = CodecHelper::readString($in);
            $numericId = LE::readSignedShort($in);
            $componentBased = CodecHelper::readBool($in);
            $version = VarInt::readSignedInt($in);
            $nbt = CodecHelper::readNbt($in);
            $pk->entries[] = new ItemTypeEntry($stringId, $numericId, $componentBased, $version, $nbt);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ItemRegistryPacket);
        VarInt::writeUnsignedInt($out, count($pk->entries));
        foreach($pk->entries as $entry){
            CodecHelper::writeString($out, $entry->stringId);
            LE::writeSignedShort($out, $entry->numericId);
            CodecHelper::writeBool($out, $entry->componentBased);
            VarInt::writeSignedInt($out, $entry->version);
            CodecHelper::writeNbt($out, $entry->componentNbt);
        }
    }
}