<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

class PlayerBlockActionData{

    public function __construct(
        public readonly int $type,
        public readonly ?BlockPosition $position,
        public readonly ?int $face
    ){}
}