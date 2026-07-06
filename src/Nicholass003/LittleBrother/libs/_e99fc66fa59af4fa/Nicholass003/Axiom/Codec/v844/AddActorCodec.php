<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Attribute;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\AddActorPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class AddActorCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AddActorPacket{
        $pk = new AddActorPacket();
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->type = CodecHelper::readString($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->motion = CodecHelper::readVec3Nullable($in);
        $pk->pitch = LE::readFloat($in);
        $pk->yaw = LE::readFloat($in);
        $pk->headYaw = LE::readFloat($in);
        $pk->bodyYaw = LE::readFloat($in);

        $attrCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $attrCount; ++$i){
            $id = CodecHelper::readString($in);
            $min = LE::readFloat($in);
            $current = LE::readFloat($in);
            $max = LE::readFloat($in);
            $pk->attributes[] = new Attribute($id, $min, $max, $current, $current, []);
        }

        $pk->metadata = $codec->entityMetadata()->read($in);
        $pk->syncedProperties = $codec->propertySync()->read($in);

        $linkCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $linkCount; ++$i){
            $pk->links[] = CodecHelper::readEntityLink($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AddActorPacket);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeString($out, $pk->type);
        CodecHelper::writeVec3($out, $pk->position);
        CodecHelper::writeVec3Nullable($out, $pk->motion);
        LE::writeFloat($out, $pk->pitch);
        LE::writeFloat($out, $pk->yaw);
        LE::writeFloat($out, $pk->headYaw);
        LE::writeFloat($out, $pk->bodyYaw);

        VarInt::writeUnsignedInt($out, count($pk->attributes));
        foreach($pk->attributes as $attribute){
            CodecHelper::writeString($out, $attribute->id);
            LE::writeFloat($out, $attribute->min);
            LE::writeFloat($out, $attribute->current);
            LE::writeFloat($out, $attribute->max);
        }

        $codec->entityMetadata()->write($out, $pk->metadata);
        $codec->propertySync()->write($out, $pk->syncedProperties);

        VarInt::writeUnsignedInt($out, count($pk->links));
        foreach($pk->links as $link){
            CodecHelper::writeEntityLink($out, $link);
        }
    }
}