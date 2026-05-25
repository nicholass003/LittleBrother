<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPaletteEntry;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\LevelSettingsData;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\NetworkPermissionsData;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\PlayerMovementSettingsData;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\ServerJoinInformation;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\ServerTelemetryData;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Vec3;

class StartGamePacket implements Packet{

    public const ID = PacketIds::START_GAME;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorUniqueId;
    public int $actorRuntimeId;
    public int $gamemode;
    public Vec3 $position;
    public float $pitch;
    public float $yaw;
    public LevelSettingsData $levelSettings;
    public string $levelId;
    public string $worldName;
    public string $premiumWorldTemplateId;
    public bool $isTrial;
    public PlayerMovementSettingsData $movement;
    public int $currentTick;
    public int $enchantmentSeed;
    /** @var BlockPaletteEntry[] */
    public array $blockPalette;
    public string $multiplayerCorrelationId;
    public bool $enableNewInventorySystem;
    public string $serverSoftwareVersion;
    public string $playerActorProperties; // raw NBT
    public int $blockPaletteChecksum;
    public string $worldTemplateId;
    public bool $enableClientSideChunkGeneration;
    public bool $blockNetworkIdsAreHashes;
    /** @deprecated v898 */
    public bool $enableTickDeathSystems = false;
    public NetworkPermissionsData $networkPermissions;

    /** @since v924 */
    public ?ServerJoinInformation $serverJoinInformation = null;
    /** @since v924 */
    public ?ServerTelemetryData $serverTelemetryData = null;
}