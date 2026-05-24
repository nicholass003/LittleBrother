<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\PackSetting;

class StringPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly string $value
    ){
        parent::__construct($name);
    }
}