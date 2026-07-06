<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\AddItemActorPacket;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class AddItemActorCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AddItemActorPacket{
        $pk = new AddItemActorPacket();
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->item = CodecHelper::readItemStackWrapper($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->motion = CodecHelper::readVec3Nullable($in);
        $pk->metadata = $codec->entityMetadata()->read($in);
        $pk->isFromFishing = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AddItemActorPacket);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeItemStackWrapper($out, $pk->item);
        CodecHelper::writeVec3($out, $pk->position);
        CodecHelper::writeVec3Nullable($out, $pk->motion);
        $codec->entityMetadata()->write($out, $pk->metadata);
        CodecHelper::writeBool($out, $pk->isFromFishing);
    }
}