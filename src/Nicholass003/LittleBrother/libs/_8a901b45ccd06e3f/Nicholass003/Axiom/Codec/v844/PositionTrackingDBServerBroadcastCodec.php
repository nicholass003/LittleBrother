<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\PositionTrackingAction;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\PositionTrackingDBServerBroadcastPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class PositionTrackingDBServerBroadcastCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PositionTrackingDBServerBroadcastPacket{
        $pk = new PositionTrackingDBServerBroadcastPacket();
        $pk->action = PositionTrackingAction::safe(Byte::readUnsigned($in));
        $pk->trackingId = VarInt::readSignedInt($in);
        $pk->nbt = CodecHelper::readNbt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PositionTrackingDBServerBroadcastPacket);
        Byte::writeUnsigned($out, $pk->action->value);
        VarInt::writeSignedInt($out, $pk->trackingId);
        CodecHelper::writeNbt($out, $pk->nbt);
    }
}