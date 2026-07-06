<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

final class BoolGameRule extends GameRule{

    public function __construct(
        public readonly bool $value,
        bool $isPlayerModifiable
    ){
        parent::__construct($isPlayerModifiable);
    }
}