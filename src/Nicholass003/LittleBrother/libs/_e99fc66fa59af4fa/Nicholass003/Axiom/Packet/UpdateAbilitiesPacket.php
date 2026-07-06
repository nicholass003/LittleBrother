<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\AbilitiesData;

class UpdateAbilitiesPacket implements Packet{

    public const ID = PacketIds::UPDATE_ABILITIES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public AbilitiesData $data;
}