<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

/** 
 * Previously ClientboundDataDrivenUICloseAllScreensPacket
 * 
 * @since v924
 */
class ClientboundDataDrivenUICloseScreenPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_DATA_DRIVEN_UI_CLOSE_SCREEN;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @since v944 */
    public ?int $formId = null;
}