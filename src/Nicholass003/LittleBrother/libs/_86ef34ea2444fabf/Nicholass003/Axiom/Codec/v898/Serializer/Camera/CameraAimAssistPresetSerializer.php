<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v898\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistPresetSerializer as BaseCameraAimAssistPresetSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPreset;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPresetExclusionDefinition;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPresetItemSettings;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CameraAimAssistPresetSerializer extends BaseCameraAimAssistPresetSerializer{

    public function read(ByteBufferReader $in) : CameraAimAssistPreset{
        $id = CodecHelper::readString($in);
        $excl = $this->readPresetExclusion($in);
        $liq = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
        $items = CodecHelper::readList($in, fn($in) => $this->readItemSettings($in));
        $defItem = CodecHelper::readOptional($in, CodecHelper::readString(...));
        $defHand = CodecHelper::readOptional($in, CodecHelper::readString(...));

        return new CameraAimAssistPreset($id, $excl, $liq, $items, $defItem, $defHand);
    }

    public function write(ByteBufferWriter $out, CameraAimAssistPreset $p) : void{
        CodecHelper::writeString($out, $p->identifier);
        $this->writePresetExclusion($out, $p->exclusionList);
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

    public function readPresetExclusion(ByteBufferReader $in) : CameraAimAssistPresetExclusionDefinition{
        $blocks = CodecHelper::readList($in, CodecHelper::readString(...));
        $entities = CodecHelper::readList($in, CodecHelper::readString(...));
        $blockTags = CodecHelper::readList($in, CodecHelper::readString(...));
        return new CameraAimAssistPresetExclusionDefinition($blocks, $entities, $blockTags);
    }

    public function writePresetExclusion(ByteBufferWriter $out, CameraAimAssistPresetExclusionDefinition $d) : void{
        CodecHelper::writeList($out, $d->blocks, CodecHelper::writeString(...));
        CodecHelper::writeList($out, $d->entities, CodecHelper::writeString(...));
        CodecHelper::writeList($out, $d->blockTags, CodecHelper::writeString(...));
    }
}