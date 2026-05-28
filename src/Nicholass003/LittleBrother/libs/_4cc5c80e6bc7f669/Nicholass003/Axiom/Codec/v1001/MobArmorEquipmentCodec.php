<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\MobArmorEquipmentPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class MobArmorEquipmentCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MobArmorEquipmentPacket{
        $pk = new MobArmorEquipmentPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->head = CodecHelper::readNetworkItemStackDescriptor($in);
        $pk->chest = CodecHelper::readNetworkItemStackDescriptor($in);
        $pk->legs = CodecHelper::readNetworkItemStackDescriptor($in);
        $pk->feet = CodecHelper::readNetworkItemStackDescriptor($in);
        $pk->body = CodecHelper::readNetworkItemStackDescriptor($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MobArmorEquipmentPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeNetworkItemStackDescriptor($out, $pk->head);
        CodecHelper::writeNetworkItemStackDescriptor($out, $pk->chest);
        CodecHelper::writeNetworkItemStackDescriptor($out, $pk->legs);
        CodecHelper::writeNetworkItemStackDescriptor($out, $pk->feet);
        CodecHelper::writeNetworkItemStackDescriptor($out, $pk->body);
    }
}