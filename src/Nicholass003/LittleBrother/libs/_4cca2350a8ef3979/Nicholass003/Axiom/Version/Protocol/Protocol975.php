<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\ActorEventCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\ClientMovementPredictionSyncCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\CraftingDataCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\DisconnectCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\InventorySlotCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\LevelSoundEventCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\MobEquipmentCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\PartyChangedCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\PlaySoundCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\ServerboundDiagnosticsCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\ServerPresenceInfoCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\ServerStoreInfoCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v975\UpdateClientOptionsCodec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ActorEventPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ClientMovementPredictionSyncPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\CraftingDataPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\DisconnectPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\InventorySlotPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\LevelSoundEventPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\MobEquipmentPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\PartyChangedPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\PlaySoundPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ServerboundDiagnosticsPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ServerPresenceInfoPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ServerStoreInfoPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\UpdateClientOptionsPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol975 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        return Protocol944::buildCodecType()->fork();
    }

    public static function build() : CodecBuilder{
        return Protocol944::build()->fork(ProtocolVersion::v975, "1.26.20")
            ->register(ServerStoreInfoPacket::ID, new ServerStoreInfoCodec())
            ->register(ServerPresenceInfoPacket::ID, new ServerPresenceInfoCodec())
            ->overrideCodecType(self::buildCodecType())
            ->override(DisconnectPacket::ID, new DisconnectCodec())
            ->override(ActorEventPacket::ID, new ActorEventCodec())
            ->override(MobEquipmentPacket::ID, new MobEquipmentCodec())
            ->override(InventorySlotPacket::ID, new InventorySlotCodec())
            ->override(CraftingDataPacket::ID, new CraftingDataCodec())
            ->override(PlaySoundPacket::ID, new PlaySoundCodec())
            ->override(LevelSoundEventPacket::ID, new LevelSoundEventCodec())
            ->override(ServerboundDiagnosticsPacket::ID, new ServerboundDiagnosticsCodec())
            ->override(ClientMovementPredictionSyncPacket::ID, new ClientMovementPredictionSyncCodec())
            ->override(UpdateClientOptionsPacket::ID, new UpdateClientOptionsCodec())
            ->override(PartyChangedPacket::ID, new PartyChangedCodec());
    }
}