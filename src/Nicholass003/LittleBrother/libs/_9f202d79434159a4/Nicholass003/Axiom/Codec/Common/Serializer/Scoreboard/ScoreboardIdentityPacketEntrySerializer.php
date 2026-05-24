<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Scoreboard;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Score\ScoreboardIdentityPacketEntry;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ScoreboardIdentityPacketEntrySerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in, bool $isRegister) : ScoreboardIdentityPacketEntry{
        $scoreboardId = VarInt::readSignedLong($in);
        $actorUniqueId = null;
        if($isRegister){
            $actorUniqueId = CodecHelper::readActorUniqueId($in);
        }
        return new ScoreboardIdentityPacketEntry($scoreboardId, $actorUniqueId);
    }

    public function write(ByteBufferWriter $out, ScoreboardIdentityPacketEntry $entry, bool $isRegister) : void{
        VarInt::writeSignedLong($out, $entry->scoreboardId);
        if($isRegister){
            CodecHelper::writeActorUniqueId($out, $entry->actorUniqueId ??
                throw new \InvalidArgumentException("ActorUniqueId required for register identity"));
        }
    }

    /**
     * @return list<ScoreboardIdentityPacketEntry>
     */
    public function readList(ByteBufferReader $in, bool $isRegister) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in, $isRegister));
    }

    /**
     * @param list<ScoreboardIdentityPacketEntry> $entries
     */
    public function writeList(ByteBufferWriter $out, array $entries, bool $isRegister) : void{
        CodecHelper::writeList($out, $entries, fn($out, $entry) => $this->write($out, $entry, $isRegister));
    }
}