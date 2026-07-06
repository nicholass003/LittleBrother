<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Skin;

class SkinImage{

    public function __construct(
        public readonly int $width,
        public readonly int $height,
        public readonly string $data
    ){}
}