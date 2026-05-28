<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeElementData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class BiomeElementDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeSurfaceMaterialDataSerializer $surfaceMaterialSerializer
    ){}

    public function surfaceMaterial() : BiomeSurfaceMaterialDataSerializer{
        return $this->surfaceMaterialSerializer;
    }

    public function withSurfaceMaterial(BiomeSurfaceMaterialDataSerializer $serializer) : static{
        return $this->with('surfaceMaterialSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeElementData{
        return new BiomeElementData(
            LE::readFloat($in),
            LE::readFloat($in),
            LE::readFloat($in),
            VarInt::readSignedInt($in),
            LE::readSignedShort($in),
            VarInt::readSignedInt($in),
            LE::readSignedShort($in),
            $this->surfaceMaterialSerializer->read($in)
        );
    }

    public function write(ByteBufferWriter $out, BiomeElementData $data) : void{
        LE::writeFloat($out, $data->noiseFrequencyScale);
        LE::writeFloat($out, $data->noiseLowerBound);
        LE::writeFloat($out, $data->noiseUpperBound);
        VarInt::writeSignedInt($out, $data->heightMinType);
        LE::writeSignedShort($out, $data->heightMin);
        VarInt::writeSignedInt($out, $data->heightMaxType);
        LE::writeSignedShort($out, $data->heightMax);

        $this->surfaceMaterialSerializer->write(
            $out,
            $data->surfaceMaterial
        );
    }
}