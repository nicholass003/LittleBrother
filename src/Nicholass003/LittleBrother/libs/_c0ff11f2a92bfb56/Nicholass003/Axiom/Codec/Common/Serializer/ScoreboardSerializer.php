<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Scoreboard\ScoreboardIdentityPacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Scoreboard\ScorePacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class ScoreboardSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private ScorePacketEntrySerializer $scoreEntrySerializer,
        private ScoreboardIdentityPacketEntrySerializer $identityEntrySerializer
    ){}

    public function scoreEntry() : ScorePacketEntrySerializer{ return $this->scoreEntrySerializer; }
    public function identityEntry() : ScoreboardIdentityPacketEntrySerializer{ return $this->identityEntrySerializer; }

    public function withScoreEntry(ScorePacketEntrySerializer $v) : self{ return $this->with('scoreEntrySerializer', $v); }
    public function withIdentityEntry(ScoreboardIdentityPacketEntrySerializer $v) : self{ return $this->with('identityEntrySerializer', $v); }
}