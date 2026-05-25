<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ShowCreditsStatus;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ShowCreditsPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ShowCreditsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ShowCreditsPacket{
        $pk = new ShowCreditsPacket();
        $pk->playerActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->status = ShowCreditsStatus::safe(VarInt::readSignedInt($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ShowCreditsPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->playerActorRuntimeId);
        VarInt::writeSignedInt($out, $pk->status->value);
    }
}