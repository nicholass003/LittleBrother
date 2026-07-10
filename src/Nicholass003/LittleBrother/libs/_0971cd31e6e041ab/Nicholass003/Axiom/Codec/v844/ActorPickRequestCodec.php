<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\ActorPickRequestPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ActorPickRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ActorPickRequestPacket{
        $pk = new ActorPickRequestPacket();
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->hotbarSlot = Byte::readUnsigned($in);
        $pk->addUserData = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ActorPickRequestPacket);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        Byte::writeUnsigned($out, $pk->hotbarSlot);
        CodecHelper::writeBool($out, $pk->addUserData);
    }
}