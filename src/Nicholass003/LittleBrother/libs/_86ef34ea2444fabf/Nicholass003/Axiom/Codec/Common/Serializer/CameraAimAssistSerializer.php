<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistCategorySerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistPresetSerializer;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistCategory;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPreset;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CameraAimAssistSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private CameraAimAssistCategorySerializer $categorySerializer,
        private CameraAimAssistPresetSerializer $presetSerializer
    ){}

    public function category() : CameraAimAssistCategorySerializer{ return $this->categorySerializer; }
    public function preset() : CameraAimAssistPresetSerializer{ return $this->presetSerializer; }

    public function withCategory(CameraAimAssistCategorySerializer $v) : static{ return $this->with('categorySerializer', $v); }
    public function withPreset(CameraAimAssistPresetSerializer $v) : static{ return $this->with('presetSerializer', $v); }

    /**
     * @return list<CameraAimAssistCategory>
     */
    public function readCategories(ByteBufferReader $in) : array{
        $count = VarInt::readUnsignedInt($in);
        $categories = [];

        for($i = 0; $i < $count; ++$i){
            $categories[] = $this->categorySerializer->read($in);
        }

        return $categories;
    }

    /**
     * @param list<CameraAimAssistCategory> $categories
     */
    public function writeCategories(ByteBufferWriter $out, array $categories) : void{
        VarInt::writeUnsignedInt($out, count($categories));

        foreach($categories as $category){
            $this->categorySerializer->write($out, $category);
        }
    }

    /**
     * @return list<CameraAimAssistPreset>
     */
    public function readPresets(ByteBufferReader $in) : array{
        $count = VarInt::readUnsignedInt($in);
        $presets = [];

        for($i = 0; $i < $count; ++$i){
            $presets[] = $this->presetSerializer->read($in);
        }

        return $presets;
    }

    /**
     * @param list<CameraAimAssistPreset> $presets
     */
    public function writePresets(ByteBufferWriter $out, array $presets) : void{
        VarInt::writeUnsignedInt($out, count($presets));

        foreach($presets as $preset){
            $this->presetSerializer->write($out, $preset);
        }
    }
}