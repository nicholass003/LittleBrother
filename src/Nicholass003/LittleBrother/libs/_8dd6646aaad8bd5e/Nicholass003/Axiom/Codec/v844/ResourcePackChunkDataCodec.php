<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ResourcePackChunkDataPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ResourcePackChunkDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePackChunkDataPacket{
        $pk = new ResourcePackChunkDataPacket();
        $pk->packId = CodecHelper::readString($in);
        $pk->chunkIndex = LE::readUnsignedInt($in);
        $pk->offset = LE::readUnsignedLong($in);
        $pk->data = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePackChunkDataPacket);
        CodecHelper::writeString($out, $pk->packId);
        LE::writeUnsignedInt($out, $pk->chunkIndex);
        LE::writeUnsignedLong($out, $pk->offset);
        CodecHelper::writeString($out, $pk->data);
    }
}