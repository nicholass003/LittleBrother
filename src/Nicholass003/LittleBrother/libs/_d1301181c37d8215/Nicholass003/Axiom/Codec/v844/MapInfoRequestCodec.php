<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\MapInfoRequestPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class MapInfoRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MapInfoRequestPacket{
        $pk = new MapInfoRequestPacket();
        $pk->mapId = CodecHelper::readActorUniqueId($in);

        $count = LE::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $pk->clientPixels[] = $codec->map()->clientPixel()->read($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MapInfoRequestPacket);
        CodecHelper::writeActorUniqueId($out, $pk->mapId);

        LE::writeUnsignedInt($out, count($pk->clientPixels));
        foreach($pk->clientPixels as $pixel){
            $codec->map()->clientPixel()->write($out, $pixel);
        }
    }
}