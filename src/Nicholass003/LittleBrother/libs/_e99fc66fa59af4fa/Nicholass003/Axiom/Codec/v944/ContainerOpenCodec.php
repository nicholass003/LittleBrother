<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\ContainerOpenPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ContainerOpenCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ContainerOpenPacket{
        $pk = new ContainerOpenPacket();
        $pk->windowId = Byte::readUnsigned($in);
        $pk->windowType = Byte::readUnsigned($in);
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ContainerOpenPacket);
        Byte::writeUnsigned($out, $pk->windowId);
        Byte::writeUnsigned($out, $pk->windowType);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
    }
}