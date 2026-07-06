<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\CameraPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CameraCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CameraPacket{
        $pk = new CameraPacket();
        $pk->cameraActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->playerActorUniqueId = CodecHelper::readActorUniqueId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CameraPacket);
        CodecHelper::writeActorUniqueId($out, $pk->cameraActorUniqueId);
        CodecHelper::writeActorUniqueId($out, $pk->playerActorUniqueId);
    }
}