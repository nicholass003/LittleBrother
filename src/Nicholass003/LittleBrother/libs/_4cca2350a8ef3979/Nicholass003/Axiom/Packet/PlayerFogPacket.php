<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;

class PlayerFogPacket implements Packet{

    public const ID = PacketIds::PLAYER_FOG;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public array $fogStack = [];
}