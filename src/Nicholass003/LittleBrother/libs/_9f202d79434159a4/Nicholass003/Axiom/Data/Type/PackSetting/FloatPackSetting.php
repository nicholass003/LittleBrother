<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\PackSetting;

class FloatPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly float $value
    ){
        parent::__construct($name);
    }
}