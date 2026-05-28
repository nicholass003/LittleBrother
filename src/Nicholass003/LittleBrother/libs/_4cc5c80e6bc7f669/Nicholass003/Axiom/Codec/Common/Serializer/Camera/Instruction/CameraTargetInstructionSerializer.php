<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Camera\CameraTargetInstruction;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraTargetInstructionSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraTargetInstruction{
        return new CameraTargetInstruction(
            CodecHelper::readOptional($in, fn($i) => CodecHelper::readVec3($i)),
            LE::readSignedLong($in)
        );
    }

    public function write(ByteBufferWriter $out, CameraTargetInstruction $t) : void{
        CodecHelper::writeOptional($out, $t->targetCenterOffset, fn($o, $v) => CodecHelper::writeVec3($o, $v));
        LE::writeSignedLong($out, $t->actorUniqueId);
    }
}