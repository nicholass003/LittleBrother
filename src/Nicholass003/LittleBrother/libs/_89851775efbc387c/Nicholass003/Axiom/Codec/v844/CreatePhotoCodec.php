<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\CreatePhotoPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CreatePhotoCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CreatePhotoPacket{
        $pk = new CreatePhotoPacket();
        $pk->actorUniqueId = LE::readSignedLong($in);
        $pk->photoName = CodecHelper::readString($in);
        $pk->photoItemName = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CreatePhotoPacket);
        LE::writeSignedLong($out, $pk->actorUniqueId);
        CodecHelper::writeString($out, $pk->photoName);
        CodecHelper::writeString($out, $pk->photoItemName);
    }
}