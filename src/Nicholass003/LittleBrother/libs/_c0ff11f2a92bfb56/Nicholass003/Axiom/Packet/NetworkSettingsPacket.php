<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class NetworkSettingsPacket implements Packet{

    public const ID = PacketIds::NETWORK_SETTINGS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $compressionThreshold;
    public int $compressionAlgorithm;
    public bool $enableClientThrottling;
    public int $clientThrottleThreshold;
    public float $clientThrottleScalar;
}