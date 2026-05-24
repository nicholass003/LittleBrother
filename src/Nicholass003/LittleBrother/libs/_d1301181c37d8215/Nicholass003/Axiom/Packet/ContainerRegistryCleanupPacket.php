<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

final class ContainerRegistryCleanupPacket implements Packet{

    public const ID = PacketIds::CONTAINER_REGISTRY_CLEANUP;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<FullContainerName> */
    public array $removedContainers = [];
}