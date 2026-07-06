<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\BossEventType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\BossEventPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BossEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BossEventPacket{
        $pk = new BossEventPacket();
        $pk->bossActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->playerActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->eventType = BossEventType::safe(Byte::readUnsigned($in));
        $pk->title = CodecHelper::readString($in);
        $pk->filteredTitle = CodecHelper::readString($in);
        $pk->healthPercent = LE::readFloat($in);
        $pk->color = Byte::readUnsigned($in);
        $pk->overlay = Byte::readUnsigned($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BossEventPacket);
        CodecHelper::writeActorUniqueId($out, $pk->bossActorUniqueId);
        CodecHelper::writeActorUniqueId($out, $pk->playerActorUniqueId ?? -1);
        Byte::writeUnsigned($out, $pk->eventType->value);
        CodecHelper::writeString($out, $pk->title);
        CodecHelper::writeString($out, $pk->filteredTitle);
        LE::writeFloat($out, $pk->healthPercent);
        Byte::writeUnsigned($out, $pk->color);
        Byte::writeUnsigned($out, $pk->overlay);
    }
}