<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

final class PlayerBlockActionWithBlockInfo{

    public function __construct(
        public readonly int $actionType,
        public readonly BlockPosition $blockPosition,
        public readonly int $face
    ){}
}