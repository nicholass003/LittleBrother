<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeDefinitionChunkGenData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeDefinitionChunkGenDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeClimateDataSerializer $climateSerializer,
        private BiomeConsolidatedFeaturesDataSerializer $consolidatedFeaturesSerializer,
        private BiomeMountainParamsDataSerializer $mountainParamsSerializer,
        private BiomeSurfaceMaterialAdjustmentDataSerializer $surfaceMaterialAdjustmentSerializer,
        private BiomeSurfaceMaterialDataSerializer $surfaceMaterialSerializer,
        private BiomeMesaSurfaceDataSerializer $mesaSurfaceSerializer,
        private BiomeCappedSurfaceDataSerializer $cappedSurfaceSerializer,
        private BiomeOverworldGenRulesDataSerializer $overworldGenRulesSerializer,
        private BiomeMultinoiseGenRulesDataSerializer $multinoiseGenRulesSerializer,
        private BiomeLegacyWorldGenRulesDataSerializer $legacyWorldGenRulesSerializer
    ){}

    public function climate() : BiomeClimateDataSerializer{ return $this->climateSerializer; }
    public function consolidatedFeatures() : BiomeConsolidatedFeaturesDataSerializer{ return $this->consolidatedFeaturesSerializer; }
    public function mountainParams() : BiomeMountainParamsDataSerializer{ return $this->mountainParamsSerializer; }
    public function surfaceMaterialAdjustment() : BiomeSurfaceMaterialAdjustmentDataSerializer{ return $this->surfaceMaterialAdjustmentSerializer; }
    public function surfaceMaterial() : BiomeSurfaceMaterialDataSerializer{ return $this->surfaceMaterialSerializer; }
    public function mesaSurface() : BiomeMesaSurfaceDataSerializer{ return $this->mesaSurfaceSerializer; }
    public function cappedSurface() : BiomeCappedSurfaceDataSerializer{ return $this->cappedSurfaceSerializer; }
    public function overworldGenRules() : BiomeOverworldGenRulesDataSerializer{ return $this->overworldGenRulesSerializer; }
    public function multinoiseGenRules() : BiomeMultinoiseGenRulesDataSerializer{ return $this->multinoiseGenRulesSerializer; }
    public function legacyWorldGenRules() : BiomeLegacyWorldGenRulesDataSerializer{ return $this->legacyWorldGenRulesSerializer; }

    public function withClimate(BiomeClimateDataSerializer $v) : self{ return $this->with('climateSerializer', $v); }
    public function withConsolidatedFeatures(BiomeConsolidatedFeaturesDataSerializer $v) : self{ return $this->with('consolidatedFeaturesSerializer', $v); }
    public function withMountainParams(BiomeMountainParamsDataSerializer $v) : self{ return $this->with('mountainParamsSerializer', $v); }
    public function withSurfaceMaterialAdjustment(BiomeSurfaceMaterialAdjustmentDataSerializer $v) : self{ return $this->with('surfaceMaterialAdjustmentSerializer', $v); }
    public function withSurfaceMaterial(BiomeSurfaceMaterialDataSerializer $v) : self{ return $this->with('surfaceMaterialSerializer', $v); }
    public function withMesaSurface(BiomeMesaSurfaceDataSerializer $v) : self{ return $this->with('mesaSurfaceSerializer', $v); }
    public function withCappedSurface(BiomeCappedSurfaceDataSerializer $v) : self{ return $this->with('cappedSurfaceSerializer', $v); }
    public function withOverworldGenRules(BiomeOverworldGenRulesDataSerializer $v) : self{ return $this->with('overworldGenRulesSerializer', $v); }
    public function withMultinoiseGenRules(BiomeMultinoiseGenRulesDataSerializer $v) : self{ return $this->with('multinoiseGenRulesSerializer', $v); }
    public function withLegacyWorldGenRules(BiomeLegacyWorldGenRulesDataSerializer $v) : self{ return $this->with('legacyWorldGenRulesSerializer', $v); }

    public function read(ByteBufferReader $in) : BiomeDefinitionChunkGenData{
        $climate = CodecHelper::readOptional($in, $this->climateSerializer->read(...));
        $consolidatedFeatures = CodecHelper::readOptional($in, $this->consolidatedFeaturesSerializer->read(...));
        $mountainParams = CodecHelper::readOptional($in, $this->mountainParamsSerializer->read(...));
        $surfaceMaterialAdjustment = CodecHelper::readOptional($in, $this->surfaceMaterialAdjustmentSerializer->read(...));
        $surfaceMaterial = CodecHelper::readOptional($in, $this->surfaceMaterialSerializer->read(...));
        $defaultOverworldSurface = CodecHelper::readBool($in);
        $swampSurface = CodecHelper::readBool($in);
        $frozenOceanSurface = CodecHelper::readBool($in);
        $theEndSurface = CodecHelper::readBool($in);
        $mesaSurface = CodecHelper::readOptional($in, $this->mesaSurfaceSerializer->read(...));
        $cappedSurface = CodecHelper::readOptional($in, $this->cappedSurfaceSerializer->read(...));
        $overworldGenRules = CodecHelper::readOptional($in, $this->overworldGenRulesSerializer->read(...));
        $multinoiseGenRules = CodecHelper::readOptional($in, $this->multinoiseGenRulesSerializer->read(...));
        $legacyWorldGenRules = CodecHelper::readOptional($in, $this->legacyWorldGenRulesSerializer->read(...));

        return new BiomeDefinitionChunkGenData(
            $climate, $consolidatedFeatures, $mountainParams, $surfaceMaterialAdjustment, $surfaceMaterial,
            $defaultOverworldSurface, $swampSurface, $frozenOceanSurface, $theEndSurface,
            $mesaSurface, $cappedSurface, $overworldGenRules, $multinoiseGenRules, $legacyWorldGenRules
        );
    }

    public function write(ByteBufferWriter $out, BiomeDefinitionChunkGenData $data) : void{
        CodecHelper::writeOptional($out, $data->climate, $this->climateSerializer->write(...));
        CodecHelper::writeOptional($out, $data->consolidatedFeatures, $this->consolidatedFeaturesSerializer->write(...));
        CodecHelper::writeOptional($out, $data->mountainParams, $this->mountainParamsSerializer->write(...));
        CodecHelper::writeOptional($out, $data->surfaceMaterialAdjustment, $this->surfaceMaterialAdjustmentSerializer->write(...));
        CodecHelper::writeOptional($out, $data->surfaceMaterial, $this->surfaceMaterialSerializer->write(...));
        CodecHelper::writeBool($out, $data->defaultOverworldSurface);
        CodecHelper::writeBool($out, $data->swampSurface);
        CodecHelper::writeBool($out, $data->frozenOceanSurface);
        CodecHelper::writeBool($out, $data->theEndSurface);
        CodecHelper::writeOptional($out, $data->mesaSurface, $this->mesaSurfaceSerializer->write(...));
        CodecHelper::writeOptional($out, $data->cappedSurface, $this->cappedSurfaceSerializer->write(...));
        CodecHelper::writeOptional($out, $data->overworldGenRules, $this->overworldGenRulesSerializer->write(...));
        CodecHelper::writeOptional($out, $data->multinoiseGenRules, $this->multinoiseGenRulesSerializer->write(...));
        CodecHelper::writeOptional($out, $data->legacyWorldGenRules, $this->legacyWorldGenRulesSerializer->write(...));
    }
}