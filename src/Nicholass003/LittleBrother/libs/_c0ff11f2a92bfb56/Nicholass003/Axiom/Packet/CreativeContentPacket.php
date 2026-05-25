<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\CreativeGroupEntry;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\CreativeItemEntry;

final class CreativeContentPacket implements Packet{

    public const ID = PacketIds::CREATIVE_CONTENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public const CATEGORY_CONSTRUCTION = 1;
    public const CATEGORY_NATURE = 2;
    public const CATEGORY_EQUIPMENT = 3;
    public const CATEGORY_ITEMS = 4;

    /** @var list<CreativeGroupEntry> */
    public array $groups = [];
    /** @var list<CreativeItemEntry> */
    public array $items = [];
}