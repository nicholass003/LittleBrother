<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec3;

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