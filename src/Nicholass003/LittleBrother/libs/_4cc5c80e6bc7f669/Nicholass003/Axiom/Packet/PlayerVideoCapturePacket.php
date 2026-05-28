<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

class PlayerVideoCapturePacket implements Packet{

    public const ID = PacketIds::PLAYER_VIDEO_CAPTURE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $recording;
    public ?int $frameRate = null;
    public ?string $filePrefix = null;
}