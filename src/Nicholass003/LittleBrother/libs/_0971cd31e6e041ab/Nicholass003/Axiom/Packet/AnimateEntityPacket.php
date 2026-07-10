<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class AnimateEntityPacket implements Packet{

    public const ID = PacketIds::ANIMATE_ENTITY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $animation;
    public string $nextState;
    public string $stopExpression;
    public int $stopExpressionVersion;
    public string $controller;
    public float $blendOutTime;
    /** @var list<int> */
    public array $actorRuntimeIds = [];
}