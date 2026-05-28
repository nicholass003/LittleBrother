<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Vec3;

class MotionPredictionHintsPacket implements Packet{

    public const ID = PacketIds::MOTION_PREDICTION_HINTS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public Vec3 $motion;
    public bool $onGround;
}