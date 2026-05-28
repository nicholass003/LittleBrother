<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\ResourcePackChunkRequestPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ResourcePackChunkRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePackChunkRequestPacket{
        $pk = new ResourcePackChunkRequestPacket();
        $pk->packId = CodecHelper::readString($in);
        $pk->chunkIndex = LE::readUnsignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePackChunkRequestPacket);
        CodecHelper::writeString($out, $pk->packId);
        LE::writeUnsignedInt($out, $pk->chunkIndex);
    }
}