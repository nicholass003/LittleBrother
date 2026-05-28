<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\ClientboundDataDrivenUICloseScreenPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientboundDataDrivenUICloseScreenCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundDataDrivenUICloseScreenPacket{
        $pk = new ClientboundDataDrivenUICloseScreenPacket();
        $pk->formId = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundDataDrivenUICloseScreenPacket);
        CodecHelper::writeOptional($out, $pk->formId, LE::writeUnsignedInt(...));
    }
}