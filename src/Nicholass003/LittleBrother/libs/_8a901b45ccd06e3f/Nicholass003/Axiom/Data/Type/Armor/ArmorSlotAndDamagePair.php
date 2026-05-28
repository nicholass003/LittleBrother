<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Armor;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ArmorSlot;

class ArmorSlotAndDamagePair{

    public function __construct(
        public readonly ArmorSlot $slot,
        public readonly int $damage
    ){}
}