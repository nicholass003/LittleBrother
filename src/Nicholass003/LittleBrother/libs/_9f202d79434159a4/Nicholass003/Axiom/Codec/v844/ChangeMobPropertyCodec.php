<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ChangeMobPropertyPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ChangeMobPropertyCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ChangeMobPropertyPacket{
        $pk = new ChangeMobPropertyPacket();
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->propertyName = CodecHelper::readString($in);
        $pk->boolValue = CodecHelper::readBool($in);
        $pk->stringValue = CodecHelper::readString($in);
        $pk->intValue = VarInt::readSignedInt($in);
        $pk->floatValue = LE::readFloat($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ChangeMobPropertyPacket);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeString($out, $pk->propertyName);
        CodecHelper::writeBool($out, $pk->boolValue);
        CodecHelper::writeString($out, $pk->stringValue);
        VarInt::writeSignedInt($out, $pk->intValue);
        LE::writeFloat($out, $pk->floatValue);
    }
}