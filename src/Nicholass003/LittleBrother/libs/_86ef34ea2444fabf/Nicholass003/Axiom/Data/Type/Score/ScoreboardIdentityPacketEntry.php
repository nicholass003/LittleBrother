<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Score;

class ScoreboardIdentityPacketEntry{

    public function __construct(
        public readonly int $scoreboardId,
        public readonly ?int $actorUniqueId = null
    ){}
}