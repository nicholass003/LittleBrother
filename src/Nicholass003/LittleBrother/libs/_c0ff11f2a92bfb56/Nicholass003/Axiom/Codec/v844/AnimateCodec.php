<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AnimatePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\AnimateAction;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class AnimateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AnimatePacket{
        $pk = new AnimatePacket();
        $pk->action = AnimateAction::safe(VarInt::readSignedInt($in));
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        if(($pk->action->value & 0x80) !== 0){
            $pk->rowingTime = LE::readFloat($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AnimatePacket);
        VarInt::writeSignedInt($out, $pk->action->value);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        if(($pk->action->value & 0x80) !== 0){
            LE::writeFloat($out, $pk->rowingTime ?? 0.0);
        }
    }
}