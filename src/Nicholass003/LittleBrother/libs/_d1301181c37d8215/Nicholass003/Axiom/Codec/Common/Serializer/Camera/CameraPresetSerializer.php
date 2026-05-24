<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Preset\CameraPresetAimAssistSerializer;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera\CameraPreset;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\ControlScheme;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class CameraPresetSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private CameraPresetAimAssistSerializer $aimAssistSerializer
    ){}

    public function aimAssist() : CameraPresetAimAssistSerializer{ return $this->aimAssistSerializer; }

    public function withAimAssist(CameraPresetAimAssistSerializer $v) : self{ return $this->with('aimAssistSerializer', $v); }

    /**
     * @return list<CameraPreset>
     */
    public function readList(ByteBufferReader $in) : array{
        $count = VarInt::readUnsignedInt($in);
        $presets = [];
        for($i = 0; $i < $count; ++$i){
            $presets[] = $this->read($in);
        }
        return $presets;
    }

    /**
     * @param list<CameraPreset> $presets
     */
    public function writeList(ByteBufferWriter $out, array $presets) : void{
        VarInt::writeUnsignedInt($out, count($presets));
        foreach($presets as $preset){
            $this->write($out, $preset);
        }
    }

    public function read(ByteBufferReader $in) : CameraPreset{
        return new CameraPreset(
            CodecHelper::readString($in),
            CodecHelper::readString($in),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, CodecHelper::readBool(...)),
            CodecHelper::readOptional($in, CodecHelper::readVec2(...)),
            CodecHelper::readOptional($in, CodecHelper::readVec2(...)),
            CodecHelper::readOptional($in, CodecHelper::readBool(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, CodecHelper::readVec2(...)),
            CodecHelper::readOptional($in, CodecHelper::readVec3(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, LE::readFloat(...)),
            CodecHelper::readOptional($in, Byte::readUnsigned(...)),
            CodecHelper::readOptional($in, CodecHelper::readBool(...)),
            CodecHelper::readOptional($in, fn($i) => $this->aimAssistSerializer->read($i)),
            CodecHelper::readOptional($in, fn($i) => ControlScheme::safe(Byte::readUnsigned($i)))
        );
    }

    public function write(ByteBufferWriter $out, CameraPreset $p) : void{
        CodecHelper::writeString($out, $p->name);
        CodecHelper::writeString($out, $p->parent);
        CodecHelper::writeOptional($out, $p->xPosition, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->yPosition, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->zPosition, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->pitch, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->yaw, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->rotationSpeed, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->snapToTarget, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $p->horizontalRotationLimit, CodecHelper::writeVec2(...));
        CodecHelper::writeOptional($out, $p->verticalRotationLimit, CodecHelper::writeVec2(...));
        CodecHelper::writeOptional($out, $p->continueTargeting, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $p->blockListeningRadius, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->viewOffset, CodecHelper::writeVec2(...));
        CodecHelper::writeOptional($out, $p->entityOffset, CodecHelper::writeVec3(...));
        CodecHelper::writeOptional($out, $p->radius, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->yawLimitMin, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->yawLimitMax, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $p->audioListenerType, Byte::writeUnsigned(...));
        CodecHelper::writeOptional($out, $p->playerEffects, CodecHelper::writeBool(...));
        CodecHelper::writeOptional($out, $p->aimAssist, fn($o, $v) => $this->aimAssistSerializer->write($o, $v));
        CodecHelper::writeOptional($out, $p->controlScheme, fn($o, $v) => Byte::writeUnsigned($o, $v->value));
    }
}