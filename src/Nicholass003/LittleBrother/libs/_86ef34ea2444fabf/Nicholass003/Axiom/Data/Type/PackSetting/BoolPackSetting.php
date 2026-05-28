<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\PackSetting;

class BoolPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly bool $value
    ){
        parent::__construct($name);
    }
}