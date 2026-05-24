<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Enchant\EnchantOption;

class PlayerEnchantOptionsPacket implements Packet{

    public const ID = PacketIds::PLAYER_ENCHANT_OPTIONS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<EnchantOption> */
    public array $options = [];
}