<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Vec3;

class MotionPredictionHintsPacket implements Packet{

    public const ID = PacketIds::MOTION_PREDICTION_HINTS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public Vec3 $motion;
    public bool $onGround;
}