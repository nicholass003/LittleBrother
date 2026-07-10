<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeOverworldGenRulesData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

final class BiomeOverworldGenRulesDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeWeightedDataSerializer $weightedSerializer,
        private BiomeConditionalTransformationDataSerializer $conditionalSerializer,
        private BiomeWeightedTemperatureDataSerializer $weightedTemperatureSerializer
    ){}

    public function weighted() : BiomeWeightedDataSerializer{
        return $this->weightedSerializer;
    }

    public function conditional() : BiomeConditionalTransformationDataSerializer{
        return $this->conditionalSerializer;
    }

    public function weightedTemperature() : BiomeWeightedTemperatureDataSerializer{
        return $this->weightedTemperatureSerializer;
    }

    public function withWeighted(BiomeWeightedDataSerializer $v) : self{
        return $this->with('weightedSerializer', $v);
    }

    public function withConditional(BiomeConditionalTransformationDataSerializer $v) : self{
        return $this->with('conditionalSerializer', $v);
    }

    public function withWeightedTemperature(BiomeWeightedTemperatureDataSerializer $v) : self{
        return $this->with('weightedTemperatureSerializer', $v);
    }

    public function read(ByteBufferReader $in) : BiomeOverworldGenRulesData{
        $hillTransformations = CodecHelper::readList($in, fn($in) => $this->weightedSerializer->read($in));
        $mutateTransformations = CodecHelper::readList($in, fn($in) => $this->weightedSerializer->read($in));
        $riverTransformations = CodecHelper::readList($in, fn($in) => $this->weightedSerializer->read($in));
        $shoreTransformations = CodecHelper::readList($in, fn($in) => $this->weightedSerializer->read($in));
        $preHillsEdges = CodecHelper::readList($in, fn($in) => $this->conditionalSerializer->read($in));
        $postShoreEdges = CodecHelper::readList($in, fn($in) => $this->conditionalSerializer->read($in));
        $climates = CodecHelper::readList($in, fn($in) => $this->weightedTemperatureSerializer->read($in));

        return new BiomeOverworldGenRulesData(
            $hillTransformations,
            $mutateTransformations,
            $riverTransformations,
            $shoreTransformations,
            $preHillsEdges,
            $postShoreEdges,
            $climates
        );
    }

    public function write(ByteBufferWriter $out, BiomeOverworldGenRulesData $data) : void{
        CodecHelper::writeList($out, $data->hillTransformations, fn($out, $h) => $this->weightedSerializer->write($out, $h));
        CodecHelper::writeList($out, $data->mutateTransformations, fn($out, $m) => $this->weightedSerializer->write($out, $m));
        CodecHelper::writeList($out, $data->riverTransformations, fn($out, $r) => $this->weightedSerializer->write($out, $r));
        CodecHelper::writeList($out, $data->shoreTransformations, fn($out, $s) => $this->weightedSerializer->write($out, $s));
        CodecHelper::writeList($out, $data->preHillsEdges, fn($out, $p) => $this->conditionalSerializer->write($out, $p));
        CodecHelper::writeList($out, $data->postShoreEdges, fn($out, $p) => $this->conditionalSerializer->write($out, $p));
        CodecHelper::writeList($out, $data->climates, fn($out, $c) => $this->weightedTemperatureSerializer->write($out, $c));
    }
}