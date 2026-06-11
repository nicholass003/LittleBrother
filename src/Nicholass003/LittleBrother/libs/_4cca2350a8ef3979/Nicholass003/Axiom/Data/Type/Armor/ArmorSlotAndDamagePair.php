<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Armor;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\ArmorSlot;

class ArmorSlotAndDamagePair{

    public function __construct(
        public readonly ArmorSlot $slot,
        public readonly int $damage
    ){}
}