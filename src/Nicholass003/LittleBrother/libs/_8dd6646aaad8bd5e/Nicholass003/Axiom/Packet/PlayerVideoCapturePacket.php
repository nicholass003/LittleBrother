<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class PlayerVideoCapturePacket implements Packet{

    public const ID = PacketIds::PLAYER_VIDEO_CAPTURE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $recording;
    public ?int $frameRate = null;
    public ?string $filePrefix = null;
}