<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\AnimateAction;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\AnimatePacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class AnimateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AnimatePacket{
        $pk = new AnimatePacket();
        $pk->action = AnimateAction::safe(Byte::readUnsigned($in));
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->data = LE::readFloat($in);
        $pk->swingSource = CodecHelper::readOptional($in, CodecHelper::readString(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AnimatePacket);
        Byte::writeUnsigned($out, $pk->action->value);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        LE::writeFloat($out, $pk->data);
        CodecHelper::writeOptional($out, $pk->swingSource, CodecHelper::writeString(...));
    }
}