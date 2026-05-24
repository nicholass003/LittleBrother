<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\BlockPosition;

class AddVolumeEntityPacket implements Packet{

    public const ID = PacketIds::ADD_VOLUME_ENTITY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $entityNetId;
    public string $nbtData; // binary NBT compound
    public string $jsonIdentifier;
    public string $instanceName;
    public BlockPosition $minBound;
    public BlockPosition $maxBound;
    public int $dimension;
    public string $engineVersion;
}