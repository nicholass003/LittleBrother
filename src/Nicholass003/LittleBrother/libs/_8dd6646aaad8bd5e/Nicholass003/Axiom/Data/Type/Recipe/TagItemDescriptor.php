<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\ItemDescriptorType;

final class TagItemDescriptor implements ItemDescriptor{

    public const ID = ItemDescriptorType::TAG;

    public function __construct(
        public readonly string $tag
    ){}
}