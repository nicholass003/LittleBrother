<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\MetadataEntry;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\MetadataPropertyType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class EntityMetadataSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return list<MetadataEntry>
     */
    public function read(ByteBufferReader $in) : array{
        $entries = [];
        $count = VarInt::readUnsignedInt($in);

        for($i = 0; $i < $count; ++$i){
            $id = VarInt::readUnsignedInt($in);
            $type = MetadataPropertyType::safe(VarInt::readUnsignedInt($in));

            $value = match($type){
                MetadataPropertyType::BYTE => Byte::readSigned($in),
                MetadataPropertyType::SHORT => LE::readSignedShort($in),
                MetadataPropertyType::INT => VarInt::readSignedInt($in),
                MetadataPropertyType::FLOAT => LE::readFloat($in),
                MetadataPropertyType::STRING => CodecHelper::readString($in),
                MetadataPropertyType::COMPOUND_TAG => CodecHelper::readNbt($in),
                MetadataPropertyType::BLOCK_POS => CodecHelper::readSignedBlockPosition($in),
                MetadataPropertyType::LONG => VarInt::readSignedLong($in),
                MetadataPropertyType::VEC3 => CodecHelper::readVec3($in),
                default => throw new \RuntimeException("Unknown metadata type")
            };

            $entries[] = new MetadataEntry($id, $type, $value);
        }

        return $entries;
    }

    /**
     * @param list<MetadataEntry> $entries
     */
    public function write(ByteBufferWriter $out, array $entries) : void{
        VarInt::writeUnsignedInt($out, count($entries));

        foreach($entries as $entry){
            VarInt::writeUnsignedInt($out, $entry->id);
            VarInt::writeUnsignedInt($out, $entry->type->value);

            match($entry->type){
                MetadataPropertyType::BYTE => Byte::writeSigned($out, $entry->value),
                MetadataPropertyType::SHORT => LE::writeSignedShort($out, $entry->value),
                MetadataPropertyType::INT => VarInt::writeSignedInt($out, $entry->value),
                MetadataPropertyType::FLOAT => LE::writeFloat($out, $entry->value),
                MetadataPropertyType::STRING => CodecHelper::writeString($out, $entry->value),
                MetadataPropertyType::COMPOUND_TAG => CodecHelper::writeNbt($out, $entry->value),
                MetadataPropertyType::BLOCK_POS => CodecHelper::writeSignedBlockPosition($out, $entry->value),
                MetadataPropertyType::LONG => VarInt::writeSignedLong($out, $entry->value),
                MetadataPropertyType::VEC3 => CodecHelper::writeVec3($out, $entry->value),
                default => throw new \RuntimeException("Unknown metadata type")
            };
        }
    }
}