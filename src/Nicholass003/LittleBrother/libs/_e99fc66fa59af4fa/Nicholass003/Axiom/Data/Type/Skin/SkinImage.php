<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Skin;

class SkinImage{

    public function __construct(
        public readonly int $width,
        public readonly int $height,
        public readonly string $data
    ){}
}