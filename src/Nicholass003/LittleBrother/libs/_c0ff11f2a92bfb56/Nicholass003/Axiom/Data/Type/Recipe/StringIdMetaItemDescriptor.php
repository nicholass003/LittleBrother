<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemDescriptorType;

final class StringIdMetaItemDescriptor implements ItemDescriptor{

    public const ID = ItemDescriptorType::STRING_ID_META;

    public function __construct(
        public readonly string $id,
        public readonly int $meta
    ){}
}