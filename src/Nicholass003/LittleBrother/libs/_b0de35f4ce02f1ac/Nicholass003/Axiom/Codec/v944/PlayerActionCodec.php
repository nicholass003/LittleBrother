<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\PlayerActionPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PlayerActionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerActionPacket{
        $pk = new PlayerActionPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->action = VarInt::readSignedInt($in);
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->resultPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->face = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerActionPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        VarInt::writeSignedInt($out, $pk->action);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
        CodecHelper::writeSignedBlockPosition($out, $pk->resultPosition);
        VarInt::writeSignedInt($out, $pk->face);
    }
}