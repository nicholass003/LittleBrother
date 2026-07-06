<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\StructureTemplateResponseType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\StructureTemplateDataResponsePacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class StructureTemplateDataResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : StructureTemplateDataResponsePacket{
        $pk = new StructureTemplateDataResponsePacket();
        $pk->structureTemplateName = CodecHelper::readString($in);
        $hasNbt = CodecHelper::readBool($in);
        if($hasNbt){
            $pk->nbt = CodecHelper::readNbt($in);
        }
        $pk->responseType = StructureTemplateResponseType::safe(Byte::readUnsigned($in));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof StructureTemplateDataResponsePacket);
        CodecHelper::writeString($out, $pk->structureTemplateName);
        CodecHelper::writeBool($out, $pk->nbt !== null);
        if($pk->nbt !== null){
            CodecHelper::writeNbt($out, $pk->nbt);
        }
        Byte::writeUnsigned($out, $pk->responseType->value);
    }
}