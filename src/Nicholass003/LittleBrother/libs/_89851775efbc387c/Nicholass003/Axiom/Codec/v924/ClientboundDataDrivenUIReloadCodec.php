<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\ClientboundDataDrivenUIReloadPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ClientboundDataDrivenUIReloadCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundDataDrivenUIReloadPacket{
        $pk = new ClientboundDataDrivenUIReloadPacket();
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundDataDrivenUIReloadPacket);
    }
}