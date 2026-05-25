<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\LessonProgressAction;

class LessonProgressPacket implements Packet{

    public const ID = PacketIds::LESSON_PROGRESS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public LessonProgressAction $action;
    public int $score;
    public string $activityId;
}