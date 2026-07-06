<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\SetDisplayObjectivePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetDisplayObjectiveCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetDisplayObjectivePacket{
        $pk = new SetDisplayObjectivePacket();
        $pk->displaySlot = CodecHelper::readString($in);
        $pk->objectiveName = CodecHelper::readString($in);
        $pk->displayName = CodecHelper::readString($in);
        $pk->criteriaName = CodecHelper::readString($in);
        $pk->sortOrder = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetDisplayObjectivePacket);
        CodecHelper::writeString($out, $pk->displaySlot);
        CodecHelper::writeString($out, $pk->objectiveName);
        CodecHelper::writeString($out, $pk->displayName);
        CodecHelper::writeString($out, $pk->criteriaName);
        VarInt::writeSignedInt($out, $pk->sortOrder);
    }
}