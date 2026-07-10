<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\ItemTypeEntry;

class ItemRegistryPacket implements Packet{

    public const ID = PacketIds::ITEM_REGISTRY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ItemTypeEntry> */
    public array $entries = [];
}