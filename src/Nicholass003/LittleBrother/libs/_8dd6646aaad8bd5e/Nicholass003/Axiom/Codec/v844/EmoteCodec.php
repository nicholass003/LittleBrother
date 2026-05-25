<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\EmoteFlags;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\EmotePacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class EmoteCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : EmotePacket{
        $pk = new EmotePacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->emoteId = CodecHelper::readString($in);
        $pk->emoteLengthTicks = VarInt::readUnsignedInt($in);
        $pk->xboxUserId = CodecHelper::readString($in);
        $pk->platformChatId = CodecHelper::readString($in);
        $pk->flags = $this->readFlags($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof EmotePacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeString($out, $pk->emoteId);
        VarInt::writeUnsignedInt($out, $pk->emoteLengthTicks);
        CodecHelper::writeString($out, $pk->xboxUserId);
        CodecHelper::writeString($out, $pk->platformChatId);
        $this->writeFlags($out, $pk->flags);
    }

    protected function readFlags(ByteBufferReader $in) : EmoteFlags{
        return EmoteFlags::fromInt(Byte::readUnsigned($in));
    }

    protected function writeFlags(ByteBufferWriter $out, EmoteFlags $flags) : void{
        Byte::writeUnsigned($out, $flags->toInt());
    }
}