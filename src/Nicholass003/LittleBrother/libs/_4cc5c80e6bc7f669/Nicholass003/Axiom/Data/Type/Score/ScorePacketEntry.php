<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Score;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\ScorePacketEntryType;

class ScorePacketEntry{

    public function __construct(
        public readonly int $scoreboardId,
        public readonly string $objectiveName,
        public readonly int $score,
        public readonly ScorePacketEntryType $type,
        public readonly ?int $actorUniqueId = null,
        public readonly ?string $customName = null
    ){
        if($type === ScorePacketEntryType::PLAYER || $type === ScorePacketEntryType::ENTITY){
            if($actorUniqueId === null){
                throw new \InvalidArgumentException("ActorUniqueId required for player/entity type");
            }
        }elseif($type === ScorePacketEntryType::FAKE_PLAYER){
            if($customName === null){
                throw new \InvalidArgumentException("CustomName required for fake player type");
            }
        }
    }
}