<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\LessonProgressAction;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\LessonProgressPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class LessonProgressCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LessonProgressPacket{
        $pk = new LessonProgressPacket();
        $pk->action = LessonProgressAction::safe(VarInt::readSignedInt($in));
        $pk->score = VarInt::readSignedInt($in);
        $pk->activityId = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LessonProgressPacket);
		VarInt::writeSignedInt($out, $pk->action->value);
		VarInt::writeSignedInt($out, $pk->score);
		CodecHelper::writeString($out, $pk->activityId);
    }
}