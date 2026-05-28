<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\UpdateBlockSyncedType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\UpdateBlockSyncedPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateBlockSyncedCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateBlockSyncedPacket{
        $pk = new UpdateBlockSyncedPacket();
        $pk->blockPosition = CodecHelper::readBlockPosition($in);
        $pk->blockRuntimeId = VarInt::readUnsignedInt($in);
        $pk->flags = VarInt::readUnsignedInt($in);
        $pk->dataLayerId = VarInt::readUnsignedInt($in);
        $pk->actorUniqueId = VarInt::readUnsignedLong($in);
        $pk->updateType = UpdateBlockSyncedType::safe(VarInt::readUnsignedLong($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateBlockSyncedPacket);
        CodecHelper::writeBlockPosition($out, $pk->blockPosition);
        VarInt::writeUnsignedInt($out, $pk->blockRuntimeId);
        VarInt::writeUnsignedInt($out, $pk->flags);
        VarInt::writeUnsignedInt($out, $pk->dataLayerId);
        VarInt::writeUnsignedLong($out, $pk->actorUniqueId);
        VarInt::writeUnsignedLong($out, $pk->updateType->value);
    }
}