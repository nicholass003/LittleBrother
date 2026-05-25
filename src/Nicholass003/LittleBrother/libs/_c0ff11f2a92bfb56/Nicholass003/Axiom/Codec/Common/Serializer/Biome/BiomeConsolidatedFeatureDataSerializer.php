<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeConsolidatedFeatureData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeConsolidatedFeatureDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeScatterParamDataSerializer $scatterSerializer
    ){}

    public function scatter() : BiomeScatterParamDataSerializer{
        return $this->scatterSerializer;
    }

    public function withScatter(BiomeScatterParamDataSerializer $serializer) : static{
        return $this->with('scatterSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeConsolidatedFeatureData{
        $scatter = $this->scatterSerializer->read($in);

        return new BiomeConsolidatedFeatureData(
            $scatter,
            LE::readSignedShort($in),
            LE::readSignedShort($in),
            LE::readSignedShort($in),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, BiomeConsolidatedFeatureData $data) : void{
        $this->scatterSerializer->write($out, $data->scatter);

        LE::writeSignedShort($out, $data->feature);
        LE::writeSignedShort($out, $data->identifier);
        LE::writeSignedShort($out, $data->pass);

        CodecHelper::writeBool($out, $data->useInternal);
    }
}