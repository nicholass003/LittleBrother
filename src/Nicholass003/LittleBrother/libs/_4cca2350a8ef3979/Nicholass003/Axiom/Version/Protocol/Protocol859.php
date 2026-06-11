<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\AnimateCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\CameraInstructionCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\ClientboundDataStoreCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\GraphicsOverrideParameterCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\Serializer\Biome\BiomeDefinitionChunkGenDataSerializer;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\Serializer\Biome\BiomeReplacementDataSerializer;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\Serializer\Camera\CameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v859\Serializer\Camera\Instruction\CameraSplineInstructionSerializer;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\AnimatePacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\CameraInstructionPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ClientboundDataStorePacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\GraphicsOverrideParameterPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol859 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        $codecType = Protocol844::buildCodecType()->fork();
        $biome = $codecType->biome();
        $definitionData = $biome->definitionData();
        $biome = $biome->withDefinitionData(
            $definitionData->withChunkGen(
                new BiomeDefinitionChunkGenDataSerializer(
                    $definitionData->chunkGen()->climate(),
                    $definitionData->chunkGen()->consolidatedFeatures(),
                    $definitionData->chunkGen()->mountainParams(),
                    $definitionData->chunkGen()->surfaceMaterialAdjustment(),
                    $definitionData->chunkGen()->surfaceMaterial(),
                    $definitionData->chunkGen()->mesaSurface(),
                    $definitionData->chunkGen()->cappedSurface(),
                    $definitionData->chunkGen()->overworldGenRules(),
                    $definitionData->chunkGen()->multinoiseGenRules(),
                    $definitionData->chunkGen()->legacyWorldGenRules(),
                    new BiomeReplacementDataSerializer()
                )
            )
        );
        $cameraInstruction = $codecType->cameraInstruction();
        return $codecType
            ->withBiome($biome)
            ->withCameraInstruction(
                new CameraInstructionSerializer(
                    $cameraInstruction->set(),
                    $cameraInstruction->fade(),
                    $cameraInstruction->target(),
                    $cameraInstruction->fov(),
                    new CameraSplineInstructionSerializer()
                )
            );

    }

    public static function build() : CodecBuilder{
        return Protocol844::build()->fork(ProtocolVersion::v859, "1.21.120")
            ->register(ClientboundDataStorePacket::ID, new ClientboundDataStoreCodec())
            ->register(GraphicsOverrideParameterPacket::ID, new GraphicsOverrideParameterCodec())
            ->overrideCodecType(self::buildCodecType())
            ->override(AnimatePacket::ID, new AnimateCodec())
            ->override(CameraInstructionPacket::ID, new CameraInstructionCodec());
    }
}