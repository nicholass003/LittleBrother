<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\SetLocalPlayerAsInitializedPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SetLocalPlayerAsInitializedCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetLocalPlayerAsInitializedPacket{
        $pk = new SetLocalPlayerAsInitializedPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetLocalPlayerAsInitializedPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
    }
}