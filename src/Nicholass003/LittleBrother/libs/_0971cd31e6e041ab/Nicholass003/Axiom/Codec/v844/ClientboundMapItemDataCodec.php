<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Map\MapDataFlags;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\ClientboundMapItemDataPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ClientboundMapItemDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundMapItemDataPacket{
        $pk = new ClientboundMapItemDataPacket();
        $pk->mapId = CodecHelper::readActorUniqueId($in);
        $pk->type = MapDataFlags::fromInt(VarInt::readUnsignedInt($in));
        $pk->dimensionId = Byte::readUnsigned($in);
        $pk->isLocked = CodecHelper::readBool($in);
        $pk->origin = CodecHelper::readSignedBlockPosition($in);

        if($pk->type->hasMapCreation()){
            $pk->parentMapIds = $codec->map()->readParentMapIds($in);
        }

        if($pk->type->requiresScale()){
            $pk->scale = Byte::readUnsigned($in);
        }

        if($pk->type->hasDecorationUpdate()){
            $pk->trackedEntities = $codec->map()->readTrackedObjects($in);
            $pk->decorations = $codec->map()->readDecorations($in);
        }

        if($pk->type->hasTextureUpdate()){
            $width = VarInt::readSignedInt($in);
            $height = VarInt::readSignedInt($in);
            $pk->xOffset = VarInt::readSignedInt($in);
            $pk->yOffset = VarInt::readSignedInt($in);
            $pixelCount = VarInt::readUnsignedInt($in);
            $expectedCount = $width * $height;
            if($pixelCount !== $expectedCount){
                throw new \RuntimeException("Expected pixel count $expectedCount, got $pixelCount");
            }
            $pk->colors = $codec->map()->readImage($in, $width, $height);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundMapItemDataPacket);
        CodecHelper::writeActorUniqueId($out, $pk->mapId);
        VarInt::writeUnsignedInt($out, $pk->type->toInt());
        Byte::writeUnsigned($out, $pk->dimensionId);
        CodecHelper::writeBool($out, $pk->isLocked);
        CodecHelper::writeSignedBlockPosition($out, $pk->origin);

        if($pk->type->hasMapCreation()){
            $codec->map()->writeParentMapIds($out, $pk->parentMapIds);
        }

        if($pk->type->requiresScale()){
            Byte::writeUnsigned($out, $pk->scale ?? throw new \InvalidArgumentException("Scale required"));
        }

        if($pk->type->hasDecorationUpdate()){
            $codec->map()->writeTrackedObjects($out, $pk->trackedEntities);
            $codec->map()->writeDecorations($out, $pk->decorations);
        }

        if($pk->type->hasTextureUpdate()){
            $image = $pk->colors ?? throw new \InvalidArgumentException("Image required");
            VarInt::writeSignedInt($out, $image->width);
            VarInt::writeSignedInt($out, $image->height);
            VarInt::writeSignedInt($out, $pk->xOffset);
            VarInt::writeSignedInt($out, $pk->yOffset);
            VarInt::writeUnsignedInt($out, $codec->map()->image()->getPixelCount($image));
            $codec->map()->writeImage($out, $image);
        }
    }
}