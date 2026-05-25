<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\PositionTrackingClientAction;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\PositionTrackingDBClientRequestPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PositionTrackingDBClientRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PositionTrackingDBClientRequestPacket{
        $pk = new PositionTrackingDBClientRequestPacket();
        $pk->action = PositionTrackingClientAction::safe(Byte::readUnsigned($in));
        $pk->trackingId = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PositionTrackingDBClientRequestPacket);
        Byte::writeUnsigned($out, $pk->action->value);
        VarInt::writeSignedInt($out, $pk->trackingId);
    }
}