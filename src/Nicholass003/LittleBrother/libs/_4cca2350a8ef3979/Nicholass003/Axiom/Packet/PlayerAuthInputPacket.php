<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\PlayerAuthInputData;

class PlayerAuthInputPacket implements Packet{

    public const ID = PacketIds::PLAYER_AUTH_INPUT;
    public const RECIPIENT = PacketRecipient::SERVER;

    public PlayerAuthInputData $input;
}