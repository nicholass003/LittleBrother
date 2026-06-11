<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\PackSetting;

class BoolPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly bool $value
    ){
        parent::__construct($name);
    }
}