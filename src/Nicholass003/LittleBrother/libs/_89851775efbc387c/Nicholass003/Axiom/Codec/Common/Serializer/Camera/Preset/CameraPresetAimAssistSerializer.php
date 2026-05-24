<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Preset;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera\CameraPresetAimAssist;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\CameraAimAssistTargetMode;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraPresetAimAssistSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraPresetAimAssist{
        return new CameraPresetAimAssist(
            CodecHelper::readOptional($in, CodecHelper::readString(...)),
            CodecHelper::readOptional($in, fn($i) => CameraAimAssistTargetMode::safe(Byte::readUnsigned($i))),
            CodecHelper::readOptional($in, CodecHelper::readVec2(...)),
            CodecHelper::readOptional($in, LE::readFloat(...))
        );
    }

    public function write(ByteBufferWriter $out, CameraPresetAimAssist $a) : void{
        CodecHelper::writeOptional($out, $a->presetId, CodecHelper::writeString(...));
        CodecHelper::writeOptional($out, $a->targetMode, fn($o, $v) => Byte::writeUnsigned($o, $v->value));
        CodecHelper::writeOptional($out, $a->viewAngle, CodecHelper::writeVec2(...));
        CodecHelper::writeOptional($out, $a->distance, LE::writeFloat(...));
    }
}