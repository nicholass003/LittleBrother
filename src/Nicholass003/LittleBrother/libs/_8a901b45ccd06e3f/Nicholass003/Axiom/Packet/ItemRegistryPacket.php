<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\ItemTypeEntry;

class ItemRegistryPacket implements Packet{

    public const ID = PacketIds::ITEM_REGISTRY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ItemTypeEntry> */
    public array $entries = [];
}