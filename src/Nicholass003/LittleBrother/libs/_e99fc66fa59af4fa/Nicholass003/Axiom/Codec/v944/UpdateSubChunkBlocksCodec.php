<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\UpdateSubChunkBlocksPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class UpdateSubChunkBlocksCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateSubChunkBlocksPacket{
        $pk = new UpdateSubChunkBlocksPacket();
        $pk->baseBlockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->layer0Updates = $codec->subChunk()->blockEntry()->readList($in);
        $pk->layer1Updates = $codec->subChunk()->blockEntry()->readList($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateSubChunkBlocksPacket);
        CodecHelper::writeSignedBlockPosition($out, $pk->baseBlockPosition);
        $codec->subChunk()->blockEntry()->writeList($out, $pk->layer0Updates);
        $codec->subChunk()->blockEntry()->writeList($out, $pk->layer1Updates);
    }
}