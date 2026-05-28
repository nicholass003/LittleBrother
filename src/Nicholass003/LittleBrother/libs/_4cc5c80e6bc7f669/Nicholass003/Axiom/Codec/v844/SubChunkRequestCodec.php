<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\SubChunkRequestPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class SubChunkRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SubChunkRequestPacket{
        $pk = new SubChunkRequestPacket();
        $pk->dimension = VarInt::readSignedInt($in);
        $pk->basePosition = CodecHelper::readSubChunk($in);

        $count = LE::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $pk->entries[] = CodecHelper::readSubChunkOffset($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SubChunkRequestPacket);
        VarInt::writeSignedInt($out, $pk->dimension);
        CodecHelper::writeSubChunk($out, $pk->basePosition);

        LE::writeUnsignedInt($out, count($pk->entries));
        foreach($pk->entries as $entry){
            CodecHelper::writeSubChunkOffset($out, $entry);
        }
    }
}