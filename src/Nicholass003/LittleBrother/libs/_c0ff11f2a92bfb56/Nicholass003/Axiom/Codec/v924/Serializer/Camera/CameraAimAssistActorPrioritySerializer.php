<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v924\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistActorPriority;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraAimAssistActorPrioritySerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraAimAssistActorPriority{
        $presetIndex = LE::readSignedInt($in);
        $categoryIndex = LE::readSignedInt($in);
        $actorIndex = LE::readSignedInt($in);
        $priority = LE::readSignedInt($in);
        return new CameraAimAssistActorPriority($presetIndex, $categoryIndex, $actorIndex, $priority);
    }

    public function write(ByteBufferWriter $out, CameraAimAssistActorPriority $p) : void{
        LE::writeSignedInt($out, $p->presetIndex);
        LE::writeSignedInt($out, $p->categoryIndex);
        LE::writeSignedInt($out, $p->actorIndex);
        LE::writeSignedInt($out, $p->priority);
    }
}