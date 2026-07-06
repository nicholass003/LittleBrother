<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\BossEventType;

class BossEventPacket implements Packet{

    public const ID = PacketIds::BOSS_EVENT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $bossActorUniqueId;
    public BossEventType $eventType;

    public int $playerActorUniqueId;
    public float $healthPercent;
    public string $title;
    public string $filteredTitle;
    /** @deprecated v1001 */
    public bool $darkenScreen;
    public int $color;
    public int $overlay;
}