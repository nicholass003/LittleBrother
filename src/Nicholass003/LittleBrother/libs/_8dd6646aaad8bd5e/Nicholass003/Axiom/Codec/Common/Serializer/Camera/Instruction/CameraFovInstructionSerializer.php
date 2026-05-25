<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Camera\CameraFovInstruction;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraFovInstructionSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraFovInstruction{
        return new CameraFovInstruction(
            LE::readFloat($in),
            LE::readFloat($in),
            CameraSetInstructionEaseType::safe(Byte::readUnsigned($in)),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, CameraFovInstruction $f) : void{
        LE::writeFloat($out, $f->fieldOfView);
        LE::writeFloat($out, $f->easeTime);
        Byte::writeUnsigned($out, $f->easeType->value);
        CodecHelper::writeBool($out, $f->clear);
    }
}