<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\UnlockedRecipesType;

class UnlockedRecipesPacket implements Packet{

    public const ID = PacketIds::UNLOCKED_RECIPES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public UnlockedRecipesType $type;
    /** @var list<string> */
    public array $recipes = [];
}