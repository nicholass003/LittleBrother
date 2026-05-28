<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\SpawnExperienceOrbPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SpawnExperienceOrbCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SpawnExperienceOrbPacket{
        $pk = new SpawnExperienceOrbPacket();
        $pk->position = CodecHelper::readVec3($in);
        $pk->amount = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SpawnExperienceOrbPacket);
        CodecHelper::writeVec3($out, $pk->position);
        VarInt::writeSignedInt($out, $pk->amount);
    }
}