<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\MetadataEntry;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Vec3;

class AddItemActorPacket implements Packet{

    public const ID = PacketIds::ADD_ITEM_ACTOR;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorUniqueId;
    public int $actorRuntimeId;
    public ItemStackWrapper $item;
    public Vec3 $position;
    public ?Vec3 $motion = null;
    /** @var array<int, MetadataEntry> */
    public array $metadata = [];
    public bool $isFromFishing = false;
}