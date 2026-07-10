<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\AgentAnimationType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\AgentAnimationPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class AgentAnimationCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AgentAnimationPacket{
        $pk = new AgentAnimationPacket();
        $pk->animationType = AgentAnimationType::safe(Byte::readUnsigned($in));
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AgentAnimationPacket);
        Byte::writeUnsigned($out, $pk->animationType->value);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
    }
}