<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\LessonProgressAction;

class LessonProgressPacket implements Packet{

    public const ID = PacketIds::LESSON_PROGRESS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public LessonProgressAction $action;
    public int $score;
    public string $activityId;
}