<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Common\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPreset;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPresetExclusionDefinition;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPresetItemSettings;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CameraAimAssistPresetSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CameraAimAssistPreset{
        $id = CodecHelper::readString($in);
        $excl = new CameraAimAssistPresetExclusionDefinition(CodecHelper::readList($in, fn($in) => CodecHelper::readString($in)), [], []);
        $liq = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        $items = CodecHelper::readList($in, fn($in) => $this->readItemSettings($in));
        $defItem = CodecHelper::readOptional($in, CodecHelper::readString(...));
        $defHand = CodecHelper::readOptional($in, CodecHelper::readString(...));

        return new CameraAimAssistPreset($id, $excl, $liq, $items, $defItem, $defHand);
    }

    public function write(ByteBufferWriter $out, CameraAimAssistPreset $p) : void{
        CodecHelper::writeString($out, $p->identifier);
        CodecHelper::writeList($out, $p->exclusionList->blocks, fn($out, $v) => CodecHelper::writeString($out, $v));
        CodecHelper::writeList($out, $p->liquidTargetingList, fn($out, $v) => CodecHelper::writeString($out, $v));
        CodecHelper::writeList($out, $p->itemSettings, fn($out, $v) => $this->writeItemSettings($out, $v));
        CodecHelper::writeOptional($out, $p->defaultItemSettings, CodecHelper::writeString(...));
        CodecHelper::writeOptional($out, $p->defaultHandSettings, CodecHelper::writeString(...));
    }

    private function readItemSettings(ByteBufferReader $in) : CameraAimAssistPresetItemSettings{
        return new CameraAimAssistPresetItemSettings(
            CodecHelper::readString($in),
            CodecHelper::readString($in)
        );
    }

    private function writeItemSettings(ByteBufferWriter $out, CameraAimAssistPresetItemSettings $s) : void{
        CodecHelper::writeString($out, $s->itemIdentifier);
        CodecHelper::writeString($out, $s->categoryName);
    }
}