<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Common\Serializer\Scoreboard;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Score\ScorePacketEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\ScorePacketEntryType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class ScorePacketEntrySerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in, bool $isRemove) : ScorePacketEntry{
        $scoreboardId = VarInt::readSignedLong($in);
        $objectiveName = CodecHelper::readString($in);
        $score = LE::readSignedInt($in);

        $type = ScorePacketEntryType::PLAYER;
        $actorUniqueId = null;
        $customName = null;

        if(!$isRemove){
            $type = ScorePacketEntryType::safe(Byte::readUnsigned($in));
            switch($type){
                case ScorePacketEntryType::PLAYER:
                case ScorePacketEntryType::ENTITY:
                    $actorUniqueId = CodecHelper::readActorUniqueId($in);
                    break;
                case ScorePacketEntryType::FAKE_PLAYER:
                    $customName = CodecHelper::readString($in);
                    break;
                default:
                    throw new \RuntimeException("Unknown score entry type {$type->value}");
            }
        }

        return new ScorePacketEntry($scoreboardId, $objectiveName, $score, $type, $actorUniqueId, $customName);
    }

    public function write(ByteBufferWriter $out, ScorePacketEntry $entry, bool $isRemove) : void{
        VarInt::writeSignedLong($out, $entry->scoreboardId);
        CodecHelper::writeString($out, $entry->objectiveName);
        LE::writeSignedInt($out, $entry->score);

        if(!$isRemove){
            Byte::writeUnsigned($out, $entry->type->value);
            switch($entry->type){
                case ScorePacketEntryType::PLAYER:
                case ScorePacketEntryType::ENTITY:
                    if($entry->actorUniqueId === null){
                        throw new \InvalidArgumentException("ActorUniqueId required for player/entity type");
                    }
                    CodecHelper::writeActorUniqueId($out, $entry->actorUniqueId);
                    break;
                case ScorePacketEntryType::FAKE_PLAYER:
                    if($entry->customName === null){
                        throw new \InvalidArgumentException("CustomName required for fake player type");
                    }
                    CodecHelper::writeString($out, $entry->customName);
                    break;
                default:
                    throw new \InvalidArgumentException("Unknown score entry type {$entry->type->value}");
            }
        }
    }

    /**
     * @return list<ScorePacketEntry>
     */
    public function readList(ByteBufferReader $in, bool $isRemove) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in, $isRemove));
    }

    /**
     * @param list<ScorePacketEntry> $entries
     */
    public function writeList(ByteBufferWriter $out, array $entries, bool $isRemove) : void{
        CodecHelper::writeList($out, $entries, fn($out, $entry) => $this->write($out, $entry, $isRemove));
    }
}