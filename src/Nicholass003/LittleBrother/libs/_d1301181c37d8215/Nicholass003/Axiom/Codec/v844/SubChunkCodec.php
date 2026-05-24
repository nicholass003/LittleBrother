<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketEntryWithCache;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketEntryWithoutCache;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\SubChunkPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class SubChunkCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : SubChunkPacket{
        $pk = new SubChunkPacket();
        $cacheEnabled = CodecHelper::readBool($in);
        $pk->cacheEnabled = $cacheEnabled;
        $pk->dimension = VarInt::readSignedInt($in);
        $pk->baseSubChunkPosition = CodecHelper::readSubChunk($in);

        $count = LE::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $common = $codec->subChunk()->entryCommon()->read($in, $cacheEnabled);
            if($cacheEnabled){
                $hash = LE::readUnsignedLong($in);
                $pk->entries[] = new SubChunkPacketEntryWithCache($common, $hash);
            }else{
                $pk->entries[] = new SubChunkPacketEntryWithoutCache($common);
            }
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof SubChunkPacket);
        CodecHelper::writeBool($out, $pk->cacheEnabled);
        VarInt::writeSignedInt($out, $pk->dimension);
        CodecHelper::writeSubChunk($out, $pk->baseSubChunkPosition);

        LE::writeUnsignedInt($out, count($pk->entries));
        foreach($pk->entries as $entry){
            if($entry instanceof SubChunkPacketEntryWithCache){
                $codec->subChunk()->entryCommon()->write($out, $entry->base, true);
                LE::writeUnsignedLong($out, $entry->usedBlobHash);
            }else{
                $codec->subChunk()->entryCommon()->write($out, $entry->base, false);
            }
        }
    }
}