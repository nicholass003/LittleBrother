<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\EntityIds;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\LevelSoundType;

class LevelSoundEventPacket implements Packet{

    public const ID = PacketIds::LEVEL_SOUND_EVENT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public LevelSoundType $sound;
    public Vec3 $position;
    public int $extraData = -1;
    public EntityIds $entityType = EntityIds::UNKNOWN;
    public bool $isBabyMob = false;
	public bool $disableRelativeVolume = false;
	public int $actorUniqueId = -1;
    /** @since v975 */
    public ?Vec3 $firePosition = null;
}