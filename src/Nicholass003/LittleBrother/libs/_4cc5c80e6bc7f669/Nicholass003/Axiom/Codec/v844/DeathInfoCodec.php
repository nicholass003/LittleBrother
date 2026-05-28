<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\DeathInfoPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class DeathInfoCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : DeathInfoPacket{
        $pk = new DeathInfoPacket();
        $pk->causeAttackName = CodecHelper::readString($in);
        $pk->messageList = CodecHelper::readList($in, fn($i) => CodecHelper::readString($i));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof DeathInfoPacket);
        CodecHelper::writeString($out, $pk->causeAttackName);
        CodecHelper::writeList($out, $pk->messageList, fn($o, $v) => CodecHelper::writeString($o, $v));
    }
}