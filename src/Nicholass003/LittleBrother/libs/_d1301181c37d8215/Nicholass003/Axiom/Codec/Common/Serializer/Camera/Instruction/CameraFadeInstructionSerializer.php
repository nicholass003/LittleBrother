<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera\CameraFadeInstruction;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera\CameraFadeInstructionColor;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera\CameraFadeInstructionTime;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraFadeInstructionSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraFadeInstruction{
        $time = CodecHelper::readOptional($in, fn($i) => $this->readTime($i));
        $color = CodecHelper::readOptional($in, fn($i) => $this->readColor($i));
        return new CameraFadeInstruction($time, $color);
    }

    public function write(ByteBufferWriter $out, CameraFadeInstruction $f) : void{
        CodecHelper::writeOptional($out, $f->time, fn($o, $v) => $this->writeTime($o, $v));
        CodecHelper::writeOptional($out, $f->color, fn($o, $v) => $this->writeColor($o, $v));
    }

    private function readTime(ByteBufferReader $in) : CameraFadeInstructionTime{
        return new CameraFadeInstructionTime(LE::readFloat($in), LE::readFloat($in), LE::readFloat($in));
    }

    private function writeTime(ByteBufferWriter $out, CameraFadeInstructionTime $t) : void{
        LE::writeFloat($out, $t->fadeInTime);
        LE::writeFloat($out, $t->stayTime);
        LE::writeFloat($out, $t->fadeOutTime);
    }

    private function readColor(ByteBufferReader $in) : CameraFadeInstructionColor{
        return new CameraFadeInstructionColor(LE::readFloat($in), LE::readFloat($in), LE::readFloat($in));
    }

    private function writeColor(ByteBufferWriter $out, CameraFadeInstructionColor $c) : void{
        LE::writeFloat($out, $c->red);
        LE::writeFloat($out, $c->green);
        LE::writeFloat($out, $c->blue);
    }
}