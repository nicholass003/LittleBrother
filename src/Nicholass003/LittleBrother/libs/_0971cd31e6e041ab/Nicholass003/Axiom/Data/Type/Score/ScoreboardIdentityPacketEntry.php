<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Score;

class ScoreboardIdentityPacketEntry{

    public function __construct(
        public readonly int $scoreboardId,
        public readonly ?int $actorUniqueId = null
    ){}
}