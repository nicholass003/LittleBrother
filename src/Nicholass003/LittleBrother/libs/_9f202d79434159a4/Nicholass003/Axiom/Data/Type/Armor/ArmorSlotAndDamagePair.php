<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Armor;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\ArmorSlot;

class ArmorSlotAndDamagePair{

    public function __construct(
        public readonly ArmorSlot $slot,
        public readonly int $damage
    ){}
}