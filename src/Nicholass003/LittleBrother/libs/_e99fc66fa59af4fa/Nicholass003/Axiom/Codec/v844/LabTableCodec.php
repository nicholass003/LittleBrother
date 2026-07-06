<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\LabTableActionType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\LabTablePacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class LabTableCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LabTablePacket{
        $pk = new LabTablePacket();
        $pk->actionType = LabTableActionType::safe(Byte::readUnsigned($in));
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->reactionType = Byte::readUnsigned($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LabTablePacket);
        Byte::writeUnsigned($out, $pk->actionType->value);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
        Byte::writeUnsigned($out, $pk->reactionType);
    }
}