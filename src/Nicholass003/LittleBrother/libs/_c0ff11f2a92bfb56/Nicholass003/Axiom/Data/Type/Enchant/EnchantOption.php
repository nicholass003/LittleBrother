<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Enchant;

class EnchantOption{

    /**
     * @param list<Enchant> $equipActivatedEnchantments
     * @param list<Enchant> $heldActivatedEnchantments
     * @param list<Enchant> $selfActivatedEnchantments
     */
    public function __construct(
        public readonly int $cost,
        public readonly int $slotFlags,
        public readonly array $equipActivatedEnchantments,
        public readonly array $heldActivatedEnchantments,
        public readonly array $selfActivatedEnchantments,
        public readonly string $name,
        public readonly int $optionId
    ){}
}