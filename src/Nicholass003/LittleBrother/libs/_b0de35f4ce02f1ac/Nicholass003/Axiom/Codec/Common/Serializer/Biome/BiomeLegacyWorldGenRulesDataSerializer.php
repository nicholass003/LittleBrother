<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeLegacyWorldGenRulesData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeLegacyWorldGenRulesDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeConditionalTransformationDataSerializer $conditionalSerializer
    ){}

    public function conditional() : BiomeConditionalTransformationDataSerializer{
        return $this->conditionalSerializer;
    }

    public function withConditional(BiomeConditionalTransformationDataSerializer $serializer) : static{
        return $this->with('conditionalSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeLegacyWorldGenRulesData{
        return new BiomeLegacyWorldGenRulesData(
            CodecHelper::readList(
                $in,
                fn($in) => $this->conditionalSerializer->read($in)
            )
        );
    }

    public function write(ByteBufferWriter $out, BiomeLegacyWorldGenRulesData $data) : void{
        CodecHelper::writeList(
            $out,
            $data->legacyPreHills,
            fn($out, $value) => $this->conditionalSerializer->write($out, $value)
        );
    }
}