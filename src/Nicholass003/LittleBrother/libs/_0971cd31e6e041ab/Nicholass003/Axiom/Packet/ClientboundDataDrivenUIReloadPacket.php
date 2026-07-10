<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

/** @since v924 */
class ClientboundDataDrivenUIReloadPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_DATA_DRIVEN_UI_RELOAD;
    public const RECIPIENT = PacketRecipient::CLIENT;
}