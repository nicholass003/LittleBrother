<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\InventorySerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\SubChunkSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v859\Serializer\Camera\CameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\AddVolumeEntityCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\AnvilDamageCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\BlockActorDataCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\BlockEventCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\ClientboundDataDrivenUICloseScreenCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\ClientboundDataDrivenUIShowScreenCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\CommandBlockUpdateCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\ContainerOpenCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\GraphicsOverrideParameterCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\LecternUpdateCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\LocatorBarCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\OpenSignCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\PartyChangedCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\PlayerActionCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\ResourcePacksReadyForValidationCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\Serializer\Camera\Instruction\CameraFovInstructionSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\Serializer\Camera\Instruction\CameraSplineInstructionSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\Serializer\Inventory\InventoryTransactionDataSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\Serializer\LevelSettingsSerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\Serializer\SubChunk\UpdateSubChunkBlocksPacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\ServerboundDataDrivenScreenClosedCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\SetSpawnPositionCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\StartGameCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\StructureBlockUpdateCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\StructureTemplateDataRequestCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\UpdateBlockCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\UpdateClientInputLocksCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\UpdateSubChunkBlocksCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v944\VoxelShapesCodec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\AddVolumeEntityPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\AnvilDamagePacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\BlockActorDataPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\BlockEventPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ClientboundDataDrivenUICloseScreenPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ClientboundDataDrivenUIShowScreenPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\CommandBlockUpdatePacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ContainerOpenPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\GraphicsOverrideParameterPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LecternUpdatePacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LocatorBarPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\OpenSignPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\PartyChangedPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\PlayerActionPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ResourcePacksReadyForValidationPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ServerboundDataDrivenScreenClosedPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\SetSpawnPositionPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\StartGamePacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\StructureBlockUpdatePacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\StructureTemplateDataRequestPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateBlockPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateClientInputLocksPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateSubChunkBlocksPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\VoxelShapesPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol944 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        $codecType = Protocol924::buildCodecType()->fork();
        $cameraInstruction = new CameraInstructionSerializer(
            $codecType->cameraInstruction()->set(),
            $codecType->cameraInstruction()->fade(),
            $codecType->cameraInstruction()->target(),
            new CameraFovInstructionSerializer(),
            new CameraSplineInstructionSerializer()
        );
        $inventory = new InventorySerializer(
            $codecType->inventory()->request(),
            $codecType->inventory()->response(),
            $codecType->inventory()->container(),
            $codecType->inventory()->action(),
            new InventoryTransactionDataSerializer($codecType->inventory()->action()),
            $codecType->inventory()->itemInteraction()
        );
        $levelSettings = new LevelSettingsSerializer(
            $codecType->levelSettings()->experiments(),
            $codecType->gameRules()
        );
        $subChunk = new SubChunkSerializer(
            $codecType->subChunk()->heightMap(),
            $codecType->subChunk()->entryCommon(),
            new UpdateSubChunkBlocksPacketEntrySerializer()
        );
        return $codecType
            ->withCameraInstruction($cameraInstruction)
            ->withInventory($inventory)
            ->withLevelSettings($levelSettings)
            ->withSubChunk($subChunk);
    }

    public static function build() : CodecBuilder{
        return Protocol924::build()->fork(ProtocolVersion::v944, "1.26.10")
            ->register(ResourcePacksReadyForValidationPacket::ID, new ResourcePacksReadyForValidationCodec())
            ->register(LocatorBarPacket::ID, new LocatorBarCodec())
            ->register(PartyChangedPacket::ID, new PartyChangedCodec())
            ->register(ServerboundDataDrivenScreenClosedPacket::ID, new ServerboundDataDrivenScreenClosedCodec())
            ->overrideCodecType(self::buildCodecType())
            ->override(StartGamePacket::ID, new StartGameCodec())
            ->override(UpdateBlockPacket::ID, new UpdateBlockCodec())
            ->override(BlockEventPacket::ID, new BlockEventCodec())
            ->override(PlayerActionPacket::ID, new PlayerActionCodec())
            ->override(SetSpawnPositionPacket::ID, new SetSpawnPositionCodec())
            ->override(ContainerOpenPacket::ID, new ContainerOpenCodec())
            ->override(BlockActorDataPacket::ID, new BlockActorDataCodec())
            ->override(CommandBlockUpdatePacket::ID, new CommandBlockUpdateCodec())
            ->override(StructureBlockUpdatePacket::ID, new StructureBlockUpdateCodec())
            ->override(LecternUpdatePacket::ID, new LecternUpdateCodec())
            ->override(StructureTemplateDataRequestPacket::ID, new StructureTemplateDataRequestCodec())
            ->override(AnvilDamagePacket::ID, new AnvilDamageCodec())
            ->override(AddVolumeEntityPacket::ID, new AddVolumeEntityCodec())
            ->override(UpdateSubChunkBlocksPacket::ID, new UpdateSubChunkBlocksCodec())
            ->override(UpdateClientInputLocksPacket::ID, new UpdateClientInputLocksCodec())
            ->override(OpenSignPacket::ID, new OpenSignCodec())
            ->override(GraphicsOverrideParameterPacket::ID, new GraphicsOverrideParameterCodec())
            ->override(ClientboundDataDrivenUIShowScreenPacket::ID, new ClientboundDataDrivenUIShowScreenCodec())
            ->override(ClientboundDataDrivenUICloseScreenPacket::ID, new ClientboundDataDrivenUICloseScreenCodec())
            ->override(VoxelShapesPacket::ID, new VoxelShapesCodec());
    }
}