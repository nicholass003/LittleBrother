<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeConditionalTransformationData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeConditionalTransformationDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeWeightedDataSerializer $weightedSerializer
    ){}

    public function weighted() : BiomeWeightedDataSerializer{
        return $this->weightedSerializer;
    }

    public function withWeighted(BiomeWeightedDataSerializer $serializer) : static{
        return $this->with('weightedSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeConditionalTransformationData{
        $weightedBiomes = CodecHelper::readList(
            $in,
            fn($in) => $this->weightedSerializer->read($in)
        );

        $conditionJSON = LE::readSignedShort($in);
        $minPassingNeighbors = LE::readUnsignedInt($in);

        return new BiomeConditionalTransformationData(
            $weightedBiomes,
            $conditionJSON,
            $minPassingNeighbors
        );
    }

    public function write(ByteBufferWriter $out, BiomeConditionalTransformationData $data) : void{
        CodecHelper::writeList(
            $out,
            $data->weightedBiomes,
            fn($out, $value) => $this->weightedSerializer->write($out, $value)
        );

        LE::writeSignedShort($out, $data->conditionJSON);
        LE::writeUnsignedInt($out, $data->minPassingNeighbors);
    }
}