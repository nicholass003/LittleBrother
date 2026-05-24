<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v944\Serializer\Camera\Instruction;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFovInstructionSerializer as BaseCameraFovInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera\CameraFovInstruction;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraFovInstructionSerializer extends BaseCameraFovInstructionSerializer{

    public function read(ByteBufferReader $in) : CameraFovInstruction{
        return new CameraFovInstruction(
            LE::readFloat($in),
            LE::readFloat($in),
            CameraSetInstructionEaseType::fromString(CodecHelper::readString($in)),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, CameraFovInstruction $f) : void{
        LE::writeFloat($out, $f->fieldOfView);
        LE::writeFloat($out, $f->easeTime);
        CodecHelper::writeString($out, $f->easeType->toString());
        CodecHelper::writeBool($out, $f->clear);
    }
}