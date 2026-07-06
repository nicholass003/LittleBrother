<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\PackSetting;

class StringPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly string $value
    ){
        parent::__construct($name);
    }
}