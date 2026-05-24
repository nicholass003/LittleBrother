<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Education\EducationUriResource;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\EduUriResourcePacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class EduUriResourceCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : EduUriResourcePacket{
        $pk = new EduUriResourcePacket();
        $pk->resource = $this->readResource($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof EduUriResourcePacket);
        $this->writeResource($out, $pk->resource);
    }

    protected function readResource(ByteBufferReader $in) : EducationUriResource{
        return new EducationUriResource(
            CodecHelper::readString($in),
            CodecHelper::readString($in)
        );
    }

    protected function writeResource(ByteBufferWriter $out, EducationUriResource $resource) : void{
        CodecHelper::writeString($out, $resource->buttonName);
        CodecHelper::writeString($out, $resource->linkUri);
    }
}