<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

final class IntGameRule extends GameRule{

    public function __construct(
        public readonly int $value,
        bool $isPlayerModifiable
    ){
        parent::__construct($isPlayerModifiable);
    }
}