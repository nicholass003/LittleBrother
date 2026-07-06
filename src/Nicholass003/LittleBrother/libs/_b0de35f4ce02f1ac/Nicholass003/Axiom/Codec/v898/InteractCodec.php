<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\InteractAction;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\InteractPacket;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class InteractCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : InteractPacket{
        $pk = new InteractPacket();
        $pk->action = InteractAction::safe(Byte::readUnsigned($in));
        $pk->targetActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->position = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof InteractPacket);
        Byte::writeUnsigned($out, $pk->action->value);
        CodecHelper::writeActorRuntimeId($out, $pk->targetActorRuntimeId);
        CodecHelper::writeOptional($out, $pk->position, CodecHelper::writeVec3(...));
    }
}