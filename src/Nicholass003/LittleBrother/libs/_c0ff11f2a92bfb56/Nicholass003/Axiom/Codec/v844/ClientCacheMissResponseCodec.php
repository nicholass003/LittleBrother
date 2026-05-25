<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\ChunkCacheBlob;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientCacheMissResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ClientCacheMissResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientCacheMissResponsePacket{
        $pk = new ClientCacheMissResponsePacket();
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $pk->blobs[] = $this->readChunkCacheBlob($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientCacheMissResponsePacket);
        VarInt::writeUnsignedInt($out, count($pk->blobs));
        foreach($pk->blobs as $blob){
            $this->writeChunkCacheBlob($out, $blob);
        }
    }

    protected function readChunkCacheBlob(ByteBufferReader $in) : ChunkCacheBlob{
        return new ChunkCacheBlob(
            LE::readUnsignedLong($in),
            CodecHelper::readString($in)
        );
    }

    protected function writeChunkCacheBlob(ByteBufferWriter $out, ChunkCacheBlob $blob) : void{
        LE::writeUnsignedLong($out, $blob->hash);
        CodecHelper::writeString($out, $blob->payload);
    }
}