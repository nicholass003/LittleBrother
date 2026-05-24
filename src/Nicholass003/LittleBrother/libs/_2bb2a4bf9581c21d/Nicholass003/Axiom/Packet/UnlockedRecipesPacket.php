<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\UnlockedRecipesType;

class UnlockedRecipesPacket implements Packet{

    public const ID = PacketIds::UNLOCKED_RECIPES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public UnlockedRecipesType $type;
    /** @var list<string> */
    public array $recipes = [];
}