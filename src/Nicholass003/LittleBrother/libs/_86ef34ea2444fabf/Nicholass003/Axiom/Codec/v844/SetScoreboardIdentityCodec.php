<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\SetScoreboardIdentityType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\SetScoreboardIdentityPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SetScoreboardIdentityCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetScoreboardIdentityPacket{
        $pk = new SetScoreboardIdentityPacket();
        $pk->type = SetScoreboardIdentityType::safe(Byte::readUnsigned($in));
        $pk->entries = $codec->scoreboard()->identityEntry()->readList($in, $pk->type === SetScoreboardIdentityType::REGISTER_IDENTITY);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetScoreboardIdentityPacket);
        Byte::writeUnsigned($out, $pk->type->value);
        $codec->scoreboard()->identityEntry()->writeList($out, $pk->entries, $pk->type === SetScoreboardIdentityType::REGISTER_IDENTITY);
    }
}