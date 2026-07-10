<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\PlayerActionPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PlayerActionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerActionPacket{
        $pk = new PlayerActionPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->action = VarInt::readSignedInt($in);
        $pk->blockPosition = CodecHelper::readBlockPosition($in);
        $pk->resultPosition = CodecHelper::readBlockPosition($in);
        $pk->face = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerActionPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        VarInt::writeSignedInt($out, $pk->action);
        CodecHelper::writeBlockPosition($out, $pk->blockPosition);
        CodecHelper::writeBlockPosition($out, $pk->resultPosition);
        VarInt::writeSignedInt($out, $pk->face);
    }
}