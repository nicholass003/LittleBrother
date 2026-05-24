<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\MapCreateLockedCopyPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class MapCreateLockedCopyCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MapCreateLockedCopyPacket{
        $pk = new MapCreateLockedCopyPacket();
        $pk->originalMapId = CodecHelper::readActorUniqueId($in);
        $pk->newMapId = CodecHelper::readActorUniqueId($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MapCreateLockedCopyPacket);
        CodecHelper::writeActorUniqueId($out, $pk->originalMapId);
        CodecHelper::writeActorUniqueId($out, $pk->newMapId);
    }
}