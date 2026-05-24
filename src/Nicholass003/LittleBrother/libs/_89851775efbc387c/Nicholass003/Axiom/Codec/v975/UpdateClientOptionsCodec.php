<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\GraphicsMode;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\UpdateClientOptionsPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class UpdateClientOptionsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateClientOptionsPacket{
        $pk = new UpdateClientOptionsPacket();
        $pk->graphicsMode = CodecHelper::readOptional(
            $in,
            fn($in) => GraphicsMode::safe(Byte::readUnsigned($in))
        );
        $pk->filterProfanityChange = CodecHelper::readOptional($in, CodecHelper::readBool(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateClientOptionsPacket);
        CodecHelper::writeOptional(
            $out,
            $pk->graphicsMode,
            fn($out, GraphicsMode $mode) => Byte::writeUnsigned($out, $mode->value)
        );
        CodecHelper::writeOptional($out, $pk->filterProfanityChange, CodecHelper::writeBool(...));
    }
}