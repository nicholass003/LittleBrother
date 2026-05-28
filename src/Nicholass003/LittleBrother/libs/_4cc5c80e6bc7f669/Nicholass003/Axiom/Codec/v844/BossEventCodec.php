<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

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
        $pk->eventType = BossEventType::safe(VarInt::readUnsignedInt($in));

        switch($pk->eventType){
            case BossEventType::REGISTER_PLAYER:
            case BossEventType::UNREGISTER_PLAYER:
            case BossEventType::QUERY:
                $pk->playerActorUniqueId = CodecHelper::readActorUniqueId($in);
                break;
            case BossEventType::SHOW:
                $pk->title = CodecHelper::readString($in);
                $pk->filteredTitle = CodecHelper::readString($in);
                $pk->healthPercent = LE::readFloat($in);
                $darkenRaw = LE::readUnsignedShort($in);
                $pk->darkenScreen = $darkenRaw === 1;
                $pk->color = VarInt::readUnsignedInt($in);
                $pk->overlay = VarInt::readUnsignedInt($in);
                break;
            case BossEventType::PROPERTIES:
                $darkenRaw = LE::readUnsignedShort($in);
                $pk->darkenScreen = $darkenRaw === 1;
            case BossEventType::TEXTURE:
                $pk->color = VarInt::readUnsignedInt($in);
                $pk->overlay = VarInt::readUnsignedInt($in);
                break;
            case BossEventType::HEALTH_PERCENT:
                $pk->healthPercent = LE::readFloat($in);
                break;
            case BossEventType::TITLE:
                $pk->title = CodecHelper::readString($in);
                $pk->filteredTitle = CodecHelper::readString($in);
                break;
            default:
                break;
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BossEventPacket);
        CodecHelper::writeActorUniqueId($out, $pk->bossActorUniqueId);
        VarInt::writeUnsignedInt($out, $pk->eventType->value);

        switch($pk->eventType){
            case BossEventType::REGISTER_PLAYER:
            case BossEventType::UNREGISTER_PLAYER:
            case BossEventType::QUERY:
                CodecHelper::writeActorUniqueId($out, $pk->playerActorUniqueId);
                break;
            case BossEventType::SHOW:
                CodecHelper::writeString($out, $pk->title);
                CodecHelper::writeString($out, $pk->filteredTitle);
                LE::writeFloat($out, $pk->healthPercent);
                LE::writeUnsignedShort($out, $pk->darkenScreen ? 1 : 0);
                VarInt::writeUnsignedInt($out, $pk->color);
                VarInt::writeUnsignedInt($out, $pk->overlay);
                break;
            case BossEventType::PROPERTIES:
                LE::writeUnsignedShort($out, $pk->darkenScreen ? 1 : 0);
                VarInt::writeUnsignedInt($out, $pk->color);
                VarInt::writeUnsignedInt($out, $pk->overlay);
                break;
            case BossEventType::TEXTURE:
                VarInt::writeUnsignedInt($out, $pk->color);
                VarInt::writeUnsignedInt($out, $pk->overlay);
                break;
            case BossEventType::HEALTH_PERCENT:
                LE::writeFloat($out, $pk->healthPercent);
                break;
            case BossEventType::TITLE:
                CodecHelper::writeString($out, $pk->title);
                CodecHelper::writeString($out, $pk->filteredTitle);
                break;
        }
    }
}