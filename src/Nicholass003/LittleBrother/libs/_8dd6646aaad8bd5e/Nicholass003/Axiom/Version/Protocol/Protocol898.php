<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\AnimateCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\AvailableCommandsCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\ClientboundDataStoreCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\ClientboundDebugRendererCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\CommandOutputCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\CommandRequestCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\InteractCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\MobEffectCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\ResourcePackStackCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Camera\CameraAimAssistCategorySerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Camera\CameraAimAssistPresetSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Command\ChainedSubCommandDataSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Command\CommandDataSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Command\CommandEnumSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Command\CommandOriginDataSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\Serializer\Command\CommandOutputMessageSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\ServerboundDataStoreCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\StartGameCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v898\TextCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\AnimatePacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\AvailableCommandsPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ClientboundDataStorePacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ClientboundDebugRendererPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\CommandOutputPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\CommandRequestPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\InteractPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\MobEffectPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ResourcePackStackPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\ServerboundDataStorePacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\StartGamePacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\TextPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol898 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        $codecType = Protocol860::buildCodecType()->fork();
        $cameraAimAssist = $codecType->cameraAimAssist();
        $cameraAimAssist = $cameraAimAssist
            ->withCategory(new CameraAimAssistCategorySerializer())
            ->withPreset(new CameraAimAssistPresetSerializer());
        $command = $codecType->command();
        $command = $command
            ->withEnum(new CommandEnumSerializer())
            ->withChainedSubCommand(new ChainedSubCommandDataSerializer())
            ->withCommandData(new CommandDataSerializer($command->commandData()->overload()))
            ->withOutputMessage(new CommandOutputMessageSerializer())
            ->withOriginData(new CommandOriginDataSerializer());
        return $codecType
            ->withCameraAimAssist($cameraAimAssist)
            ->withCommand($command);
    }

    public static function build() : CodecBuilder{
        return Protocol860::build()->fork(ProtocolVersion::v898, "1.21.130")
            ->register(ServerboundDataStorePacket::ID, new ServerboundDataStoreCodec())
            ->overrideCodecType(self::buildCodecType())
            ->override(ResourcePackStackPacket::ID, new ResourcePackStackCodec())
            ->override(TextPacket::ID, new TextCodec())
            ->override(StartGamePacket::ID, new StartGameCodec())
            ->override(MobEffectPacket::ID, new MobEffectCodec())
            ->override(InteractPacket::ID, new InteractCodec())
            ->override(AnimatePacket::ID, new AnimateCodec())
            ->override(AvailableCommandsPacket::ID, new AvailableCommandsCodec())
            ->override(CommandOutputPacket::ID, new CommandOutputCodec())
            ->override(CommandRequestPacket::ID, new CommandRequestCodec())
            ->override(ClientboundDebugRendererPacket::ID, new ClientboundDebugRendererCodec())
            ->override(ClientboundDataStorePacket::ID, new ClientboundDataStoreCodec());
    }
}