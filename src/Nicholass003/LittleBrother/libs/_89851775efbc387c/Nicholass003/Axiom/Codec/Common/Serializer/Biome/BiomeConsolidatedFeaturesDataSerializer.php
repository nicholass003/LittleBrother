<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeConsolidatedFeaturesData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeConsolidatedFeaturesDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeConsolidatedFeatureDataSerializer $featureSerializer
    ){}

    public function feature() : BiomeConsolidatedFeatureDataSerializer{
        return $this->featureSerializer;
    }

    public function withFeature(BiomeConsolidatedFeatureDataSerializer $serializer) : static{
        return $this->with('featureSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeConsolidatedFeaturesData{
        return new BiomeConsolidatedFeaturesData(
            CodecHelper::readList(
                $in,
                fn($in) => $this->featureSerializer->read($in)
            )
        );
    }

    public function write(ByteBufferWriter $out, BiomeConsolidatedFeaturesData $data) : void{
        CodecHelper::writeList(
            $out,
            $data->features,
            fn($out, $value) => $this->featureSerializer->write($out, $value)
        );
    }
}