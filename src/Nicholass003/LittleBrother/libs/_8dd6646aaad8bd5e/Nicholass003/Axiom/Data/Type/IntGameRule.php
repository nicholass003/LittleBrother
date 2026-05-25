<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

final class IntGameRule extends GameRule{

    public function __construct(
        public readonly int $value,
        bool $isPlayerModifiable
    ){
        parent::__construct($isPlayerModifiable);
    }
}