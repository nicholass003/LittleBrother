<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Skin;

class SkinAnimation{

    public function __construct(
        public readonly SkinImage $image,
        public readonly int $type,
        public readonly float $frames,
        public readonly int $expressionType
    ){}
}