<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Vec3;

final class CorrectPlayerMovePredictionPacket implements Packet{

    public const ID = PacketIds::CORRECT_PLAYER_MOVE_PREDICTION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public const PREDICTION_TYPE_PLAYER = 0;
    public const PREDICTION_TYPE_VEHICLE = 1;

    public Vec3 $position;
    public Vec3 $delta;
    public bool $onGround;
    public int $tick;
    public int $predictionType;
    public Vec2 $vehicleRotation;
    public ?float $vehicleAngularVelocity;
}