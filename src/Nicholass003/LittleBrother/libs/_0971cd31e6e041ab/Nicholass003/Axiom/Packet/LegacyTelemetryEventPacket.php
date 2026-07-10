<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\LegacyTelemetryEventType;

class LegacyTelemetryEventPacket implements Packet{

    public const ID = PacketIds::LEGACY_TELEMETRY_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $playerRuntimeId;
    public int $eventData;
    public LegacyTelemetryEventType $type;
}