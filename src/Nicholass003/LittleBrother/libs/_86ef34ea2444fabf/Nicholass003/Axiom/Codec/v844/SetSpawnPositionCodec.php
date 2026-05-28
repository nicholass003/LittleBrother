<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\SetSpawnPositionPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetSpawnPositionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetSpawnPositionPacket{
        $pk = new SetSpawnPositionPacket();
        $pk->spawnType = VarInt::readSignedInt($in);
        $pk->spawnPosition = CodecHelper::readBlockPosition($in);
        $pk->dimension = VarInt::readSignedInt($in);
        $pk->causingBlockPosition = CodecHelper::readBlockPosition($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetSpawnPositionPacket);
        VarInt::writeSignedInt($out, $pk->spawnType);
        CodecHelper::writeBlockPosition($out, $pk->spawnPosition);
        VarInt::writeSignedInt($out, $pk->dimension);
        CodecHelper::writeBlockPosition($out, $pk->causingBlockPosition);
    }
}