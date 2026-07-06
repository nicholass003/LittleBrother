<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

final class PlayerBlockActionWithBlockInfo{

    public function __construct(
        public readonly int $actionType,
        public readonly BlockPosition $blockPosition,
        public readonly int $face
    ){}
}