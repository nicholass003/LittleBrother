<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\ItemDescriptorType;

final class IntIdMetaItemDescriptor implements ItemDescriptor{

    public const ID = ItemDescriptorType::INT_ID_META;

    public function __construct(
        public readonly int $id,
        public readonly int $meta
    ){}
}