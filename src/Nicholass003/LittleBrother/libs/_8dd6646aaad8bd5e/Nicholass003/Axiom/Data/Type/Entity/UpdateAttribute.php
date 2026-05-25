<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Entity;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\AttributeModifier;

class UpdateAttribute{

    /**
     * @param AttributeModifier[] $modifiers
     */
    public function __construct(
        public readonly string $id,
        public readonly float $min,
        public readonly float $max,
        public readonly float $current,
        public readonly float $defaultMin,
        public readonly float $defaultMax,
        public readonly float $default,
        public readonly array $modifiers
    ){}
}