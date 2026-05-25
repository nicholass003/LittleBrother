<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\PackSetting\PackSetting;

class ServerboundPackSettingChangePacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_PACK_SETTING_CHANGE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $packId; // UUID string
    public PackSetting $packSetting;
}