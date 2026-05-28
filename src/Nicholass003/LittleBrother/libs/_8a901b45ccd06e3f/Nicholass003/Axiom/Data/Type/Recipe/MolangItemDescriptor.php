<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ItemDescriptorType;

final class MolangItemDescriptor implements ItemDescriptor{

    public const ID = ItemDescriptorType::MOLANG;

    public function __construct(
        public readonly string $molangExpression,
        public readonly int $molangVersion
    ){}
}