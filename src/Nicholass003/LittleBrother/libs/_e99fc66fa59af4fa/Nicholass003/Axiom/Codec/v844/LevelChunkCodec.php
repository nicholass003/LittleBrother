<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\LevelChunkPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class LevelChunkCodec implements Codec{

    private const CLIENT_REQUEST_FULL_COLUMN_FAKE_COUNT = 0xFFFFFFFF;
    private const CLIENT_REQUEST_TRUNCATED_COLUMN_FAKE_COUNT = 0xFFFFFFFE;

    public function decode(ByteBufferReader $in, CodecType $codec) : LevelChunkPacket{
        $pk = new LevelChunkPacket();
        $position = CodecHelper::readChunkPosition($in);
        $pk->position = $position;
        $dimensionId = VarInt::readSignedInt($in);
        $pk->dimensionId = $dimensionId;
        $rawCount = VarInt::readUnsignedInt($in);
        $clientRequests = false;
        $subChunkCount = $rawCount;

        if($rawCount === self::CLIENT_REQUEST_FULL_COLUMN_FAKE_COUNT){
            $clientRequests = true;
            $subChunkCount = PHP_INT_MAX;

        }elseif($rawCount === self::CLIENT_REQUEST_TRUNCATED_COLUMN_FAKE_COUNT){
            $clientRequests = true;
            $subChunkCount = LE::readUnsignedShort($in);
        }
        $pk->subChunkCount = $subChunkCount;
        $pk->clientSubChunkRequestsEnabled = $clientRequests;

        $usedBlobHashes = null;

        $cacheEnabled = CodecHelper::readBool($in);
        if($cacheEnabled){
            $count = VarInt::readUnsignedInt($in);
            if($count > 64){
                throw new \RuntimeException("Too many blob hashes: $count");
            }

            $usedBlobHashes = [];

            for($i = 0; $i < $count; $i++){
                $usedBlobHashes[] = LE::readUnsignedLong($in);
            }
        }
        $pk->usedBlobHashes = $usedBlobHashes;

        $payload = CodecHelper::readString($in);
        $pk->payload = $payload;
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LevelChunkPacket);
        CodecHelper::writeChunkPosition($out, $pk->position);
        VarInt::writeSignedInt($out, $pk->dimensionId);

        if($pk->clientSubChunkRequestsEnabled){
            if($pk->subChunkCount === PHP_INT_MAX){
                VarInt::writeUnsignedInt($out, self::CLIENT_REQUEST_FULL_COLUMN_FAKE_COUNT);
            }else{
                VarInt::writeUnsignedInt($out, self::CLIENT_REQUEST_TRUNCATED_COLUMN_FAKE_COUNT);
                LE::writeUnsignedShort($out, $pk->subChunkCount);
            }
        }else{
            VarInt::writeUnsignedInt($out, $pk->subChunkCount);
        }

        CodecHelper::writeBool($out, $pk->usedBlobHashes !== null);

        if($pk->usedBlobHashes !== null){
            VarInt::writeUnsignedInt($out, count($pk->usedBlobHashes));

            foreach($pk->usedBlobHashes as $hash){
                LE::writeUnsignedLong($out, $hash);
            }
        }

        CodecHelper::writeString($out, $pk->payload);
    }
}