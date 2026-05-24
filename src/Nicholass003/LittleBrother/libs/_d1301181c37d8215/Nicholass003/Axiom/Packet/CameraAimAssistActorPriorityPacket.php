<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistActorPriority;

/** @since v924 */
class CameraAimAssistActorPriorityPacket implements Packet{

    public const ID = PacketIds::CAMERA_AIM_ASSIST_ACTOR_PRIORITY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<CameraAimAssistActorPriority> */
    public array $priorityData = [];
}