<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\BossEventType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\BossEventPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class BossEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BossEventPacket{
        $pk = new BossEventPacket();
        $pk->bossActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->playerActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->eventType = BossEventType::safe(VarInt::readUnsignedInt($in));
        $pk->title = CodecHelper::readString($in);
        $pk->filteredTitle = CodecHelper::readString($in);
        $pk->healthPercent = LE::readFloat($in);
        $pk->color = VarInt::readUnsignedInt($in);
        $pk->overlay = VarInt::readUnsignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BossEventPacket);
        CodecHelper::writeActorUniqueId($out, $pk->bossActorUniqueId);
        CodecHelper::writeActorUniqueId($out, $pk->playerActorUniqueId);
        VarInt::writeUnsignedInt($out, $pk->eventType->value);
        CodecHelper::writeString($out, $pk->title);
        CodecHelper::writeString($out, $pk->filteredTitle);
        LE::writeFloat($out, $pk->healthPercent);
        VarInt::writeUnsignedInt($out, $pk->color);
        VarInt::writeUnsignedInt($out, $pk->overlay);
    }
}