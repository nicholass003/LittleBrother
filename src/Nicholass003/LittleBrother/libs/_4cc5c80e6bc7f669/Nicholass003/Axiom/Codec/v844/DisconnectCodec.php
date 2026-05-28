<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\DisconnectPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class DisconnectCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : DisconnectPacket{
        $pk = new DisconnectPacket();
        $pk->reason = VarInt::readSignedInt($in);
        $skipMessage = CodecHelper::readBool($in);
        $pk->message = $skipMessage ? null : CodecHelper::readString($in);
        $pk->filteredMessage = $skipMessage ? null : CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof DisconnectPacket);
        VarInt::writeSignedInt($out, $pk->reason);
        $skipMessage = $pk->message === null && $pk->filteredMessage === null;
        CodecHelper::writeBool($out, $skipMessage);
        if(!$skipMessage){
            CodecHelper::writeString($out, $pk->message ?? '');
            CodecHelper::writeString($out, $pk->filteredMessage ?? '');
        }
    }
}