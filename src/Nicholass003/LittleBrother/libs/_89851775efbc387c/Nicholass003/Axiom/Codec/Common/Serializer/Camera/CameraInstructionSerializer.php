<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFadeInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFovInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraSetInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraTargetInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera\CameraFadeInstruction;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera\CameraFovInstruction;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera\CameraSetInstruction;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera\CameraTargetInstruction;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CameraInstructionSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private CameraSetInstructionSerializer $setSerializer,
        private CameraFadeInstructionSerializer $fadeSerializer,
        private CameraTargetInstructionSerializer $targetSerializer,
        private CameraFovInstructionSerializer $fovSerializer
    ){}

    public function set() : CameraSetInstructionSerializer{ return $this->setSerializer; }

    public function fade() : CameraFadeInstructionSerializer{ return $this->fadeSerializer; }

    public function target() : CameraTargetInstructionSerializer{ return $this->targetSerializer; }

    public function fov() : CameraFovInstructionSerializer{ return $this->fovSerializer; }

    public function withSet(CameraSetInstructionSerializer $v) : self{ return $this->with("setSerializer", $v); }
    public function withFade(CameraFadeInstructionSerializer $v) : self{ return $this->with("fadeSerializer", $v); }
    public function withTarget(CameraTargetInstructionSerializer $v) : self{ return $this->with("targetSerializer", $v); }
    public function withFov(CameraFovInstructionSerializer $v) : self{ return $this->with("fovSerializer", $v); }

    public function readSetInstruction(ByteBufferReader $in) : CameraSetInstruction{
        return $this->setSerializer->read($in);
    }

    public function writeSetInstruction(ByteBufferWriter $out, CameraSetInstruction $set) : void{
        $this->setSerializer->write($out, $set);
    }

    public function readFadeInstruction(ByteBufferReader $in) : CameraFadeInstruction{
        return $this->fadeSerializer->read($in);
    }

    public function writeFadeInstruction(ByteBufferWriter $out, CameraFadeInstruction $fade) : void{
        $this->fadeSerializer->write($out, $fade);
    }

    public function readTargetInstruction(ByteBufferReader $in) : CameraTargetInstruction{
        return $this->targetSerializer->read($in);
    }

    public function writeTargetInstruction(ByteBufferWriter $out, CameraTargetInstruction $target) : void{
        $this->targetSerializer->write($out, $target);
    }

    public function readFovInstruction(ByteBufferReader $in) : CameraFovInstruction{
        return $this->fovSerializer->read($in);
    }

    public function writeFovInstruction(ByteBufferWriter $out, CameraFovInstruction $fov) : void{
        $this->fovSerializer->write($out, $fov);
    }
}