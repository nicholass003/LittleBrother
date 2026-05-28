<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\DisconnectPacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class DisconnectCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : DisconnectPacket{
        $pk = new DisconnectPacket();
        $pk->reason = VarInt::readSignedInt($in);
        $skipMessage = VarInt::readUnsignedInt($in) !== 0;
        $pk->message = $skipMessage ? null : CodecHelper::readString($in);
        $pk->filteredMessage = $skipMessage ? null : CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof DisconnectPacket);
        VarInt::writeSignedInt($out, $pk->reason);
        $skipMessage = $pk->message === null && $pk->filteredMessage === null;
        VarInt::writeUnsignedInt($out, $skipMessage ? 1 : 0);
        if(!$skipMessage){
            CodecHelper::writeString($out, $pk->message ?? '');
            CodecHelper::writeString($out, $pk->filteredMessage ?? '');
        }
    }
}