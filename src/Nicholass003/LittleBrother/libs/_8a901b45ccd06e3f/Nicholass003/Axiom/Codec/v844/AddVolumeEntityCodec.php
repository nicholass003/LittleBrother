<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\AddVolumeEntityPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class AddVolumeEntityCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AddVolumeEntityPacket{
        $pk = new AddVolumeEntityPacket();
        $pk->entityNetId = VarInt::readUnsignedInt($in);
        $pk->nbtData = CodecHelper::readNbt($in);
        $pk->jsonIdentifier = CodecHelper::readString($in);
        $pk->instanceName = CodecHelper::readString($in);
        $pk->minBound = CodecHelper::readBlockPosition($in);
        $pk->maxBound = CodecHelper::readBlockPosition($in);
        $pk->dimension = VarInt::readSignedInt($in);
        $pk->engineVersion = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AddVolumeEntityPacket);
        VarInt::writeUnsignedInt($out, $pk->entityNetId);
        CodecHelper::writeNbt($out, $pk->nbtData);
        CodecHelper::writeString($out, $pk->jsonIdentifier);
        CodecHelper::writeString($out, $pk->instanceName);
        CodecHelper::writeBlockPosition($out, $pk->minBound);
        CodecHelper::writeBlockPosition($out, $pk->maxBound);
        VarInt::writeSignedInt($out, $pk->dimension);
        CodecHelper::writeString($out, $pk->engineVersion);
    }
}