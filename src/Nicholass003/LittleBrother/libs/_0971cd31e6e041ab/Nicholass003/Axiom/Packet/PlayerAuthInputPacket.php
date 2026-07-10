<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\PlayerAuthInputData;

class PlayerAuthInputPacket implements Packet{

    public const ID = PacketIds::PLAYER_AUTH_INPUT;
    public const RECIPIENT = PacketRecipient::SERVER;

    public PlayerAuthInputData $input;
}