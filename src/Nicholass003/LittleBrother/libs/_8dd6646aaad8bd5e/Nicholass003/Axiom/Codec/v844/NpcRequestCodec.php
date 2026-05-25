<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\NpcRequestType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\NpcRequestPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class NpcRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : NpcRequestPacket{
        $pk = new NpcRequestPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->requestType = NpcRequestType::safe(Byte::readUnsigned($in));
        $pk->commandString = CodecHelper::readString($in);
        $pk->actionIndex = Byte::readUnsigned($in);
        $pk->sceneName = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof NpcRequestPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        Byte::writeUnsigned($out, $pk->requestType->value);
        CodecHelper::writeString($out, $pk->commandString);
        Byte::writeUnsigned($out, $pk->actionIndex);
        CodecHelper::writeString($out, $pk->sceneName);
    }
}