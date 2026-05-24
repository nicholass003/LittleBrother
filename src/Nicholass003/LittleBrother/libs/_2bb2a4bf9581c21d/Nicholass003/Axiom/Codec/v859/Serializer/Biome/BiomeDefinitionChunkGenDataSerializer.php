<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v859\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeCappedSurfaceDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeClimateDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeConsolidatedFeaturesDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeDefinitionChunkGenDataSerializer as BaseBiomeDefinitionChunkGenDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeLegacyWorldGenRulesDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeMesaSurfaceDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeMountainParamsDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeMultinoiseGenRulesDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeOverworldGenRulesDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeSurfaceMaterialAdjustmentDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeSurfaceMaterialDataSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeDefinitionChunkGenData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeDefinitionChunkGenDataSerializer extends BaseBiomeDefinitionChunkGenDataSerializer{

    public function __construct(
        BiomeClimateDataSerializer $climateSerializer,
        BiomeConsolidatedFeaturesDataSerializer $consolidatedFeaturesSerializer,
        BiomeMountainParamsDataSerializer $mountainParamsSerializer,
        BiomeSurfaceMaterialAdjustmentDataSerializer $surfaceMaterialAdjustmentSerializer,
        BiomeSurfaceMaterialDataSerializer $surfaceMaterialSerializer,
        BiomeMesaSurfaceDataSerializer $mesaSurfaceSerializer,
        BiomeCappedSurfaceDataSerializer $cappedSurfaceSerializer,
        BiomeOverworldGenRulesDataSerializer $overworldGenRulesSerializer,
        BiomeMultinoiseGenRulesDataSerializer $multinoiseGenRulesSerializer,
        BiomeLegacyWorldGenRulesDataSerializer $legacyWorldGenRulesSerializer,
        private BiomeReplacementDataSerializer $replacementDataSerializer
    ){
        return parent::__construct(
            $climateSerializer,
            $consolidatedFeaturesSerializer,
            $mountainParamsSerializer,
            $surfaceMaterialAdjustmentSerializer,
            $surfaceMaterialSerializer,
            $mesaSurfaceSerializer,
            $cappedSurfaceSerializer,
            $overworldGenRulesSerializer,
            $multinoiseGenRulesSerializer,
            $legacyWorldGenRulesSerializer
        );
    }

    public function replacementData() : BiomeReplacementDataSerializer{ return $this->replacementDataSerializer; }

    public function withReplacementData(BiomeReplacementDataSerializer $v) : self{ return $this->with('replacementDataSerializer', $v); }

    public function read(ByteBufferReader $in) : BiomeDefinitionChunkGenData{
        $climate = CodecHelper::readOptional($in, $this->climate()->read(...));
        $consolidatedFeatures = CodecHelper::readOptional($in, $this->consolidatedFeatures()->read(...));
        $mountainParams = CodecHelper::readOptional($in, $this->mountainParams()->read(...));
        $surfaceMaterialAdjustment = CodecHelper::readOptional($in, $this->surfaceMaterialAdjustment()->read(...));
        $surfaceMaterial = CodecHelper::readOptional($in, $this->surfaceMaterial()->read(...));
        $defaultOverworldSurface = CodecHelper::readBool($in);
        $swampSurface = CodecHelper::readBool($in);
        $frozenOceanSurface = CodecHelper::readBool($in);
        $theEndSurface = CodecHelper::readBool($in);
        $mesaSurface = CodecHelper::readOptional($in, $this->mesaSurface()->read(...));
        $cappedSurface = CodecHelper::readOptional($in, $this->cappedSurface()->read(...));
        $overworldGenRules = CodecHelper::readOptional($in, $this->overworldGenRules()->read(...));
        $multinoiseGenRules = CodecHelper::readOptional($in, $this->multinoiseGenRules()->read(...));
        $legacyWorldGenRules = CodecHelper::readOptional($in, $this->legacyWorldGenRules()->read(...));
        $replacementsData = CodecHelper::readOptional($in, $this->replacementDataSerializer->readList(...));
        return new BiomeDefinitionChunkGenData(
            $climate, $consolidatedFeatures, $mountainParams, $surfaceMaterialAdjustment, $surfaceMaterial,
            $defaultOverworldSurface, $swampSurface, $frozenOceanSurface, $theEndSurface,
            $mesaSurface, $cappedSurface, $overworldGenRules, $multinoiseGenRules, $legacyWorldGenRules, $replacementsData
        );
    }

    public function write(ByteBufferWriter $out, BiomeDefinitionChunkGenData $data) : void{
        CodecHelper::writeOptional($out, $data->climate, $this->climate()->write(...));
        CodecHelper::writeOptional($out, $data->consolidatedFeatures, $this->consolidatedFeatures()->write(...));
        CodecHelper::writeOptional($out, $data->mountainParams, $this->mountainParams()->write(...));
        CodecHelper::writeOptional($out, $data->surfaceMaterialAdjustment, $this->surfaceMaterialAdjustment()->write(...));
        CodecHelper::writeOptional($out, $data->surfaceMaterial, $this->surfaceMaterial()->write(...));
        CodecHelper::writeBool($out, $data->defaultOverworldSurface);
        CodecHelper::writeBool($out, $data->swampSurface);
        CodecHelper::writeBool($out, $data->frozenOceanSurface);
        CodecHelper::writeBool($out, $data->theEndSurface);
        CodecHelper::writeOptional($out, $data->mesaSurface, $this->mesaSurface()->write(...));
        CodecHelper::writeOptional($out, $data->cappedSurface, $this->cappedSurface()->write(...));
        CodecHelper::writeOptional($out, $data->overworldGenRules, $this->overworldGenRules()->write(...));
        CodecHelper::writeOptional($out, $data->multinoiseGenRules, $this->multinoiseGenRules()->write(...));
        CodecHelper::writeOptional($out, $data->legacyWorldGenRules, $this->legacyWorldGenRules()->write(...));
        CodecHelper::writeOptional($out, $data->replacementsData, $this->replacementDataSerializer->write(...));
    }
}