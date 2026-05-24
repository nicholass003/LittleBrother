<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\SetActorDataPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetActorDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetActorDataPacket{
        $pk = new SetActorDataPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->metadata = $codec->entityMetadata()->read($in);
        $pk->syncedProperties = $codec->propertySync()->read($in);
        $pk->tick = VarInt::readUnsignedLong($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetActorDataPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        $codec->entityMetadata()->write($out, $pk->metadata);
        $codec->propertySync()->write($out, $pk->syncedProperties);
        VarInt::writeUnsignedLong($out, $pk->tick);
    }
}