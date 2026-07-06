<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\BiomeDefinitionData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeDefinitionDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeDefinitionChunkGenDataSerializer $chunkGenSerializer
    ){}

    public function chunkGen() : BiomeDefinitionChunkGenDataSerializer{
        return $this->chunkGenSerializer;
    }

    public function withChunkGen(BiomeDefinitionChunkGenDataSerializer $serializer) : static{
        return $this->with('chunkGenSerializer', $serializer);
    }

    public function read(ByteBufferReader $in) : BiomeDefinitionData{
        $nameIndex = LE::readUnsignedShort($in);
        $id = LE::readUnsignedShort($in);
        $temperature = LE::readFloat($in);
        $downfall = LE::readFloat($in);
        $foliageSnow = LE::readFloat($in);
        $depth = LE::readFloat($in);
        $scale = LE::readFloat($in);
        $mapWaterColor = LE::readSignedInt($in);
        $hasRain = CodecHelper::readBool($in);
        $tagIndexes = CodecHelper::readOptional($in, fn($i) => CodecHelper::readList($i, LE::readUnsignedShort(...)));
        $chunkGenData = CodecHelper::readOptional($in, $this->chunkGenSerializer->read(...));

        return new BiomeDefinitionData(
            $nameIndex,
            $id,
            $temperature,
            $downfall,
            $foliageSnow,
            $depth,
            $scale,
            $mapWaterColor,
            $hasRain,
            $tagIndexes,
            $chunkGenData
        );
    }

    public function write(ByteBufferWriter $out, BiomeDefinitionData $data) : void{
        LE::writeUnsignedShort($out, $data->nameIndex);
        LE::writeUnsignedShort($out, $data->id);
        LE::writeFloat($out, $data->temperature);
        LE::writeFloat($out, $data->downfall);
        LE::writeFloat($out, $data->foliageSnow);
        LE::writeFloat($out, $data->depth);
        LE::writeFloat($out, $data->scale);
        LE::writeSignedInt($out, $data->mapWaterColor);

        CodecHelper::writeBool($out, $data->hasRain);

        CodecHelper::writeOptional($out, $data->tagIndexes, function($out, $list) : void{
            CodecHelper::writeList($out, $list, LE::writeUnsignedShort(...));
        });

        CodecHelper::writeOptional(
            $out,
            $data->chunkGenData,
            $this->chunkGenSerializer->write(...)
        );
    }
}