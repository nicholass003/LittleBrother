<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeSurfaceMaterialAdjustmentData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeSurfaceMaterialAdjustmentDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeElementDataSerializer $elementSerializer
    ){}

    public function element() : BiomeElementDataSerializer{
        return $this->elementSerializer;
    }

    public function withElement(BiomeElementDataSerializer $serializer) : static{
        return $this->with('elementSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeSurfaceMaterialAdjustmentData{
        return new BiomeSurfaceMaterialAdjustmentData(
            CodecHelper::readList(
                $in,
                fn($in) => $this->elementSerializer->read($in)
            )
        );
    }

    public function write(ByteBufferWriter $out, BiomeSurfaceMaterialAdjustmentData $data) : void{
        CodecHelper::writeList(
            $out,
            $data->adjustments,
            fn($out, $value) => $this->elementSerializer->write($out, $value)
        );
    }
}