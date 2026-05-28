<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\StructureTemplateRequestType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\StructureTemplateDataRequestPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class StructureTemplateDataRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : StructureTemplateDataRequestPacket{
        $pk = new StructureTemplateDataRequestPacket();
        $pk->structureTemplateName = CodecHelper::readString($in);
        $pk->structureBlockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->structureSettings = $codec->structure()->settings()->read($in);
        $pk->requestType = StructureTemplateRequestType::safe(Byte::readUnsigned($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof StructureTemplateDataRequestPacket);
        CodecHelper::writeString($out, $pk->structureTemplateName);
        CodecHelper::writeSignedBlockPosition($out, $pk->structureBlockPosition);
        $codec->structure()->settings()->write($out, $pk->structureSettings);
        Byte::writeUnsigned($out, $pk->requestType->value);
    }
}