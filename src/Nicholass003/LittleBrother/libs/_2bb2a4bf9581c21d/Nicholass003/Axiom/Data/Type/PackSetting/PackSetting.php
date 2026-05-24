<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\PackSetting;

abstract class PackSetting{

    public function __construct(
        public readonly string $name
    ){}
}