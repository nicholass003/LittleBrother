<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\ResourcePacksReadyForValidationPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ResourcePacksReadyForValidationCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ResourcePacksReadyForValidationPacket{
        $pk = new ResourcePacksReadyForValidationPacket();
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ResourcePacksReadyForValidationPacket);
    }
}