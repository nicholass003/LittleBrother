<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\SetSpawnPositionPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class SetSpawnPositionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SetSpawnPositionPacket{
        $pk = new SetSpawnPositionPacket();
        $pk->spawnType = VarInt::readSignedInt($in);
        $pk->spawnPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->dimension = VarInt::readSignedInt($in);
        $pk->causingBlockPosition = CodecHelper::readSignedBlockPosition($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SetSpawnPositionPacket);
        VarInt::writeSignedInt($out, $pk->spawnType);
        CodecHelper::writeSignedBlockPosition($out, $pk->spawnPosition);
        VarInt::writeSignedInt($out, $pk->dimension);
        CodecHelper::writeSignedBlockPosition($out, $pk->causingBlockPosition);
    }
}