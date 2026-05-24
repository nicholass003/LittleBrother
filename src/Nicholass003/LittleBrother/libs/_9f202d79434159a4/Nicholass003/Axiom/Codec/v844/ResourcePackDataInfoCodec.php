<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\ResourcePackType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ResourcePackDataInfoPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ResourcePackDataInfoCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePackDataInfoPacket{
        $pk = new ResourcePackDataInfoPacket();
        $pk->packId = CodecHelper::readString($in);
        $pk->maxChunkSize = LE::readUnsignedInt($in);
        $pk->chunkCount = LE::readUnsignedInt($in);
        $pk->compressedPackSize = LE::readUnsignedLong($in);
        $pk->sha256 = CodecHelper::readString($in);
        $pk->isPremium = CodecHelper::readBool($in);
        $pk->packType = ResourcePackType::safe(Byte::readUnsigned($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePackDataInfoPacket);
        CodecHelper::writeString($out, $pk->packId);
        LE::writeUnsignedInt($out, $pk->maxChunkSize);
        LE::writeUnsignedInt($out, $pk->chunkCount);
        LE::writeUnsignedLong($out, $pk->compressedPackSize);
        CodecHelper::writeString($out, $pk->sha256);
        CodecHelper::writeBool($out, $pk->isPremium);
        Byte::writeUnsigned($out, $pk->packType->value);
    }
}