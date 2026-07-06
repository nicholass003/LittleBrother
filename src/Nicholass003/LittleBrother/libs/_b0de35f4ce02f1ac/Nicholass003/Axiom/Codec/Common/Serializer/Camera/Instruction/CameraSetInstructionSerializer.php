<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraSetInstruction;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraSetInstructionEase;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraSetInstructionRotation;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraSetInstructionSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraSetInstruction{
        return new CameraSetInstruction(
            LE::readUnsignedInt($in),
            CodecHelper::readOptional($in, fn($i) => $this->readEase($i)),
            CodecHelper::readOptional($in, fn($i) => CodecHelper::readVec3($i)),
            CodecHelper::readOptional($in, fn($i) => $this->readRotation($i)),
            CodecHelper::readOptional($in, fn($i) => CodecHelper::readVec3($i)),
            CodecHelper::readOptional($in, fn($i) => CodecHelper::readVec2($i)),
            CodecHelper::readOptional($in, fn($i) => CodecHelper::readVec3($i)),
            CodecHelper::readOptional($in, fn($i) => CodecHelper::readBool($i)),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, CameraSetInstruction $s) : void{
        LE::writeUnsignedInt($out, $s->preset);
        CodecHelper::writeOptional($out, $s->ease, fn($o, $v) => $this->writeEase($o, $v));
        CodecHelper::writeOptional($out, $s->cameraPosition, fn($o, $v) => CodecHelper::writeVec3($o, $v));
        CodecHelper::writeOptional($out, $s->rotation, fn($o, $v) => $this->writeRotation($o, $v));
        CodecHelper::writeOptional($out, $s->facingPosition, fn($o, $v) => CodecHelper::writeVec3($o, $v));
        CodecHelper::writeOptional($out, $s->viewOffset, fn($o, $v) => CodecHelper::writeVec2($o, $v));
        CodecHelper::writeOptional($out, $s->entityOffset, fn($o, $v) => CodecHelper::writeVec3($o, $v));
        CodecHelper::writeOptional($out, $s->default, fn($o, $v) => CodecHelper::writeBool($o, $v));
        CodecHelper::writeBool($out, $s->ignoreStartingValuesComponent);
    }

    private function readEase(ByteBufferReader $in) : CameraSetInstructionEase{
        return new CameraSetInstructionEase(Byte::readUnsigned($in), LE::readFloat($in));
    }

    private function writeEase(ByteBufferWriter $out, CameraSetInstructionEase $e) : void{
        Byte::writeUnsigned($out, $e->type);
        LE::writeFloat($out, $e->duration);
    }

    private function readRotation(ByteBufferReader $in) : CameraSetInstructionRotation{
        return new CameraSetInstructionRotation(LE::readFloat($in), LE::readFloat($in));
    }

    private function writeRotation(ByteBufferWriter $out, CameraSetInstructionRotation $r) : void{
        LE::writeFloat($out, $r->pitch);
        LE::writeFloat($out, $r->yaw);
    }
}