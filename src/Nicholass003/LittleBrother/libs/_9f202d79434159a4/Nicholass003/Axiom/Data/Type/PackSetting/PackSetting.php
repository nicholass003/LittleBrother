<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\PackSetting;

abstract class PackSetting{

    public function __construct(
        public readonly string $name
    ){}
}