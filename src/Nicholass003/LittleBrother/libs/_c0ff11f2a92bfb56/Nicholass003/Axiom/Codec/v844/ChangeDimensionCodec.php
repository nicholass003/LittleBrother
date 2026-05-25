<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ChangeDimensionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ChangeDimensionCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ChangeDimensionPacket{
        $pk = new ChangeDimensionPacket();
        $pk->dimension = VarInt::readSignedInt($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->respawn = CodecHelper::readBool($in);
        $pk->loadingScreenId = CodecHelper::readOptional($in, fn($i) => LE::readUnsignedInt($i));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ChangeDimensionPacket);
        VarInt::writeSignedInt($out, $pk->dimension);
        CodecHelper::writeVec3($out, $pk->position);
        CodecHelper::writeBool($out, $pk->respawn);
        CodecHelper::writeOptional($out, $pk->loadingScreenId, fn($o, $v) => LE::writeUnsignedInt($o, $v));
    }
}