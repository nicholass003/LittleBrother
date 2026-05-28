<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\SoundEventType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundUpdateSoundDataPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientboundUpdateSoundDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : Packet{
        $pk = new ClientboundUpdateSoundDataPacket();
        $pk->serverSoundHandle = LE::readUnsignedLong($in);
        $pk->soundEvent = SoundEventType::fromString(CodecHelper::readString($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundUpdateSoundDataPacket);
        LE::writeUnsignedLong($out, $pk->serverSoundHandle);
        CodecHelper::writeString($out, $pk->soundEvent->toString());
    }
}