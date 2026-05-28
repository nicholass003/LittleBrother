<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundDataDrivenUIShowScreenPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientboundDataDrivenUIShowScreenCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundDataDrivenUIShowScreenPacket{
        $pk = new ClientboundDataDrivenUIShowScreenPacket();
        $pk->screenId = CodecHelper::readString($in);
        $pk->formId = LE::readUnsignedInt($in);
        $pk->dataInstanceId = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundDataDrivenUIShowScreenPacket);
        CodecHelper::writeString($out, $pk->screenId);
        LE::writeUnsignedInt($out, $pk->formId);
        CodecHelper::writeOptional($out, $pk->dataInstanceId, LE::writeUnsignedInt(...));
    }
}