<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\PackSetting;

class FloatPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly float $value
    ){
        parent::__construct($name);
    }
}