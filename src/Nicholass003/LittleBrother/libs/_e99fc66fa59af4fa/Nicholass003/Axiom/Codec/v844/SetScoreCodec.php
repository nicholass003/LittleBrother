<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\SetScorePacketType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\SetScorePacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SetScoreCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetScorePacket{
        $pk = new SetScorePacket();
        $pk->type = SetScorePacketType::safe(Byte::readUnsigned($in));
        $isRemove = $pk->type === SetScorePacketType::REMOVE;
        $pk->entries = $codec->scoreboard()->scoreEntry()->readList($in, $isRemove);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetScorePacket);
        Byte::writeUnsigned($out, $pk->type->value);
        $isRemove = $pk->type === SetScorePacketType::REMOVE;
        $codec->scoreboard()->scoreEntry()->writeList($out, $pk->entries, $isRemove);
    }
}