<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\MobArmorEquipmentPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class MobArmorEquipmentCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MobArmorEquipmentPacket{
        $pk = new MobArmorEquipmentPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->head = CodecHelper::readItemStackWrapper($in);
        $pk->chest = CodecHelper::readItemStackWrapper($in);
        $pk->legs = CodecHelper::readItemStackWrapper($in);
        $pk->feet = CodecHelper::readItemStackWrapper($in);
        $pk->body = CodecHelper::readItemStackWrapper($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MobArmorEquipmentPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeItemStackWrapper($out, $pk->head);
        CodecHelper::writeItemStackWrapper($out, $pk->chest);
        CodecHelper::writeItemStackWrapper($out, $pk->legs);
        CodecHelper::writeItemStackWrapper($out, $pk->feet);
        CodecHelper::writeItemStackWrapper($out, $pk->body);
    }
}