<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

final class BoolGameRule extends GameRule{

    public function __construct(
        public readonly bool $value,
        bool $isPlayerModifiable
    ){
        parent::__construct($isPlayerModifiable);
    }
}