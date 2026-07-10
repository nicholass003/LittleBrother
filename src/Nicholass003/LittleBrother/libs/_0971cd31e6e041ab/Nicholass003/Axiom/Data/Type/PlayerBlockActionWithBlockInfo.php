<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

final class PlayerBlockActionWithBlockInfo{

    public function __construct(
        public readonly int $actionType,
        public readonly BlockPosition $blockPosition,
        public readonly int $face
    ){}
}