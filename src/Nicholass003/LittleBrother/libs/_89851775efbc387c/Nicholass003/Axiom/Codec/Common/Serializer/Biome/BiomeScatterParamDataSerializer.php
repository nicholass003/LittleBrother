<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeScatterParamData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

final class BiomeScatterParamDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeCoordinateDataSerializer $coordinateSerializer
    ){}

    public function coordinate() : BiomeCoordinateDataSerializer{
        return $this->coordinateSerializer;
    }

    public function withCoordinate(BiomeCoordinateDataSerializer $serializer) : static{
        return $this->with('coordinateSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeScatterParamData{
        $coordinates = CodecHelper::readList(
            $in,
            fn($in) => $this->coordinateSerializer->read($in)
        );

        return new BiomeScatterParamData(
            $coordinates,
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            LE::readSignedShort($in),
            LE::readSignedInt($in),
            LE::readSignedInt($in),
            VarInt::readSignedInt($in),
            LE::readSignedShort($in)
        );
    }

    public function write(ByteBufferWriter $out, BiomeScatterParamData $data) : void{
        CodecHelper::writeList(
            $out,
            $data->coordinates,
            fn($out, $value) => $this->coordinateSerializer->write($out, $value)
        );

        VarInt::writeSignedInt($out, $data->evalOrder);
        VarInt::writeSignedInt($out, $data->chancePercentType);
        LE::writeSignedShort($out, $data->chancePercent);
        LE::writeSignedInt($out, $data->chanceNumerator);
        LE::writeSignedInt($out, $data->chanceDenominator);
        VarInt::writeSignedInt($out, $data->iterationsType);
        LE::writeSignedShort($out, $data->iterations);
    }
}