<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\FeatureRegistryPacketEntry;

class FeatureRegistryPacket implements Packet{

    public const ID = PacketIds::FEATURE_REGISTRY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<FeatureRegistryPacketEntry> */
    public array $entries = [];
}