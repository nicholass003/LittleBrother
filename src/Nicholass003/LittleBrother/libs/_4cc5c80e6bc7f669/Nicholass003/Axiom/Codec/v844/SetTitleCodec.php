<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\SetTitlePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetTitleCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetTitlePacket{
        $pk = new SetTitlePacket();
        $pk->type = VarInt::readSignedInt($in);
        $pk->text = CodecHelper::readString($in);
        $pk->fadeInTime = VarInt::readSignedInt($in);
        $pk->stayTime = VarInt::readSignedInt($in);
        $pk->fadeOutTime = VarInt::readSignedInt($in);
        $pk->xboxUserId = CodecHelper::readString($in);
        $pk->platformOnlineId = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetTitlePacket);
        VarInt::writeSignedInt($out, $pk->type);
        CodecHelper::writeString($out, $pk->text);
        VarInt::writeSignedInt($out, $pk->fadeInTime);
        VarInt::writeSignedInt($out, $pk->stayTime);
        VarInt::writeSignedInt($out, $pk->fadeOutTime);
        CodecHelper::writeString($out, $pk->xboxUserId);
        CodecHelper::writeString($out, $pk->platformOnlineId);
    }
}