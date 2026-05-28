<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\PhotoTransferPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class PhotoTransferCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PhotoTransferPacket{
        $pk = new PhotoTransferPacket();
        $pk->photoName = CodecHelper::readString($in);
        $pk->photoData = CodecHelper::readString($in);
        $pk->bookId = CodecHelper::readString($in);
        $pk->type = Byte::readUnsigned($in);
        $pk->sourceType = Byte::readUnsigned($in);
        $pk->ownerActorUniqueId = LE::readSignedLong($in);
        $pk->newPhotoName = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PhotoTransferPacket);
        CodecHelper::writeString($out, $pk->photoName);
        CodecHelper::writeString($out, $pk->photoData);
        CodecHelper::writeString($out, $pk->bookId);
        Byte::writeUnsigned($out, $pk->type);
        Byte::writeUnsigned($out, $pk->sourceType);
        LE::writeSignedLong($out, $pk->ownerActorUniqueId);
        CodecHelper::writeString($out, $pk->newPhotoName);
    }
}