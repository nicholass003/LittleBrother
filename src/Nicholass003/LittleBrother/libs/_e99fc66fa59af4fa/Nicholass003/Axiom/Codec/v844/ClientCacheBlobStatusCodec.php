<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\ClientCacheBlobStatusPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ClientCacheBlobStatusCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientCacheBlobStatusPacket{
        $pk = new ClientCacheBlobStatusPacket();
        $missCount = VarInt::readUnsignedInt($in);
        $hitCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $missCount; ++$i){
            $pk->missHashes[] = LE::readUnsignedLong($in);
        }
        for($i = 0; $i < $hitCount; ++$i){
            $pk->hitHashes[] = LE::readUnsignedLong($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientCacheBlobStatusPacket);
        VarInt::writeUnsignedInt($out, count($pk->missHashes));
        VarInt::writeUnsignedInt($out, count($pk->hitHashes));
        foreach($pk->missHashes as $hash){
            LE::writeUnsignedLong($out, $hash);
        }
        foreach($pk->hitHashes as $hash){
            LE::writeUnsignedLong($out, $hash);
        }
    }
}