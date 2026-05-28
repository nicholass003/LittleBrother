<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Enchant\EnchantOption;

class PlayerEnchantOptionsPacket implements Packet{

    public const ID = PacketIds::PLAYER_ENCHANT_OPTIONS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<EnchantOption> */
    public array $options = [];
}