<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\PackSetting;

class StringPackSetting extends PackSetting{

    public function __construct(
        string $name,
        public readonly string $value
    ){
        parent::__construct($name);
    }
}