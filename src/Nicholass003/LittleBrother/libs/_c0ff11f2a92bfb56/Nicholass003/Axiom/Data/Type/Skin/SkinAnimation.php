<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Skin;

class SkinAnimation{

    public function __construct(
        public readonly SkinImage $image,
        public readonly int $type,
        public readonly float $frames,
        public readonly int $expressionType
    ){}
}