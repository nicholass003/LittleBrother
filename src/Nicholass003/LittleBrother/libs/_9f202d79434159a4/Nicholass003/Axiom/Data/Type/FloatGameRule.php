<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type;

final class FloatGameRule extends GameRule{

    public function __construct(
        public readonly float $value,
        bool $isPlayerModifiable
    ){
        parent::__construct($isPlayerModifiable);
    }
}