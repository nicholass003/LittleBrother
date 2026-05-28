<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v859\Serializer\Camera\CameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\BookEditCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\CameraAimAssistActorPriorityCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\CameraSplineCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ClientboundDataDrivenUICloseScreenCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ClientboundDataDrivenUIReloadCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ClientboundDataDrivenUIShowScreenCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ClientboundDataStoreCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ClientboundTextureShiftCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\GraphicsOverrideParameterCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\Serializer\Camera\CameraAimAssistActorPrioritySerializer;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\Serializer\Camera\Instruction\CameraSplineInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\Serializer\CameraAimAssistSerializer;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\Serializer\LevelSettingsSerializer;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\ServerboundDiagnosticsCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\StartGameCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\TextCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v924\VoxelShapesCodec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\BookEditPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\CameraAimAssistActorPriorityPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\CameraSplinePacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundDataDrivenUICloseScreenPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundDataDrivenUIReloadPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundDataDrivenUIShowScreenPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundDataStorePacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientboundTextureShiftPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\GraphicsOverrideParameterPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ServerboundDiagnosticsPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\StartGamePacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\TextPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\VoxelShapesPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol924 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        $codecType = Protocol898::buildCodecType()->fork();
        $cameraAimAssist = new CameraAimAssistSerializer(
            $codecType->cameraAimAssist()->category(),
            $codecType->cameraAimAssist()->preset(),
            new CameraAimAssistActorPrioritySerializer()
        );
        $cameraInstruction = new CameraInstructionSerializer(
            $codecType->cameraInstruction()->set(),
            $codecType->cameraInstruction()->fade(),
            $codecType->cameraInstruction()->target(),
            $codecType->cameraInstruction()->fov(),
            new CameraSplineInstructionSerializer()
        );
        $levelSettings = new LevelSettingsSerializer(
            $codecType->levelSettings()->experiments(),
            $codecType->gameRules()
        );
        return $codecType
            ->withCameraAimAssist($cameraAimAssist)
            ->withCameraInstruction($cameraInstruction)
            ->withLevelSettings($levelSettings);
    }

    public static function build() : CodecBuilder{
        return Protocol898::build()->fork(ProtocolVersion::v924, "1.26.0")
            ->register(ClientboundDataDrivenUIShowScreenPacket::ID, new ClientboundDataDrivenUIShowScreenCodec())
            ->register(ClientboundDataDrivenUICloseScreenPacket::ID, new ClientboundDataDrivenUICloseScreenCodec())
            ->register(ClientboundDataDrivenUIReloadPacket::ID, new ClientboundDataDrivenUIReloadCodec())
            ->register(ClientboundTextureShiftPacket::ID, new ClientboundTextureShiftCodec())
            ->register(VoxelShapesPacket::ID, new VoxelShapesCodec())
            ->register(CameraSplinePacket::ID, new CameraSplineCodec())
            ->register(CameraAimAssistActorPriorityPacket::ID, new CameraAimAssistActorPriorityCodec())
            ->overrideCodecType(self::buildCodecType())
            ->override(TextPacket::ID, new TextCodec())
            ->override(StartGamePacket::ID, new StartGameCodec())
            ->override(BookEditPacket::ID, new BookEditCodec())
            ->override(ServerboundDiagnosticsPacket::ID, new ServerboundDiagnosticsCodec())
            ->override(ClientboundDataStorePacket::ID, new ClientboundDataStoreCodec())
            ->override(GraphicsOverrideParameterPacket::ID, new GraphicsOverrideParameterCodec());
    }
}