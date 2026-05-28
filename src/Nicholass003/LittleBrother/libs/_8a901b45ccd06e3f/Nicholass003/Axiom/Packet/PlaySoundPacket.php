<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

class PlaySoundPacket implements Packet{

    public const ID = PacketIds::PLAY_SOUND;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $soundName;
    public Vec3 $position;
    public float $volume;
    public float $pitch;
    /** @since v975 */
    public ?int $serverSoundHandle = null;
}