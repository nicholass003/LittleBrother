<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\EntityLink;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\MetadataEntry;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\PropertySyncData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Vec3;

class AddPlayerPacket implements Packet{

    public const ID = PacketIds::ADD_PLAYER;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $uuid; // 16 byte binary
    public string $username;
    public int $actorRuntimeId;
    public string $platformChatId = "";
    public Vec3 $position;
    public ?Vec3 $motion = null;
    public float $pitch = 0.0;
    public float $yaw = 0.0;
    public float $headYaw = 0.0;
    public ItemStackWrapper $item;
    public int $gameMode;
    /** @var array<int, MetadataEntry> */
    public array $metadata = [];
    public PropertySyncData $syncedProperties;
    public UpdateAbilitiesPacket $abilitiesPacket;
    /** @var EntityLink[] */
    public array $links = [];
    public string $deviceId = "";
    public int $buildPlatform;
}