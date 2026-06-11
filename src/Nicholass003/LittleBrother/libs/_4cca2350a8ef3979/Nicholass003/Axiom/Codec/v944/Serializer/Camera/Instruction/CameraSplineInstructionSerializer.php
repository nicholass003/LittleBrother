<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v944\Serializer\Camera\Instruction;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v924\Serializer\Camera\Instruction\CameraSplineInstructionSerializer as BaseCameraSplineInstructionSerializer;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera\CameraProgressOption;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera\CameraRotationOption;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera\CameraSplineInstruction;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CameraSplineInstructionSerializer extends BaseCameraSplineInstructionSerializer{

    public function read(ByteBufferReader $in) : CameraSplineInstruction{
        $totalTime = LE::readFloat($in);
        $easeType = Byte::readUnsigned($in);
        $curve = CodecHelper::readList($in, fn($in) => CodecHelper::readVec3($in));
        $progressKeyFrames = CodecHelper::readList($in, fn($in) => new CameraProgressOption(LE::readFloat($in), LE::readFloat($in), CameraSetInstructionEaseType::fromString(CodecHelper::readString($in))));
        $rotationOptions = CodecHelper::readList($in, fn($in) => new CameraRotationOption(CodecHelper::readVec3($in), LE::readFloat($in), CameraSetInstructionEaseType::fromString(CodecHelper::readString($in))));
        $splineIdentifier = CodecHelper::readString($in);
        $loadFromJson = CodecHelper::readBool($in);
        return new CameraSplineInstruction($totalTime, $easeType, $curve, $progressKeyFrames, $rotationOptions, $splineIdentifier, $loadFromJson);
    }

    public function write(ByteBufferWriter $out, CameraSplineInstruction $spline) : void{
        LE::writeFloat($out, $spline->totalTime);
        Byte::writeUnsigned($out, $spline->easeType);
        CodecHelper::writeList($out, $spline->curve, fn($out, $curve) => CodecHelper::writeVec3($out, $curve));
        CodecHelper::writeList($out, $spline->progressKeyFrames, function($out, $d) : void{
            LE::writeFloat($out, $d->value);
            LE::writeFloat($out, $d->time);
            CodecHelper::writeString($out, $d->easeType->toString());
        });
        CodecHelper::writeList($out, $spline->rotationOptions, function($out, $d) : void{
            CodecHelper::writeVec3($out, $d->value);
            LE::writeFloat($out, $d->time);
            CodecHelper::writeString($out, $d->easeType->toString());
        });
        CodecHelper::writeString($out, $spline->splineIdentifier);
        CodecHelper::writeBool($out, $spline->loadFromJson);
    }
}