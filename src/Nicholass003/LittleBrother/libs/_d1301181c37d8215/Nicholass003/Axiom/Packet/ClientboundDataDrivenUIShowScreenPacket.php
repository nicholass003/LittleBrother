<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

/** @since v924 */
class ClientboundDataDrivenUIShowScreenPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_DATA_DRIVEN_UI_SHOW_SCREEN;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $screenId = '';

    /** @since v944 */
    public int $formId = 0;
    /** @since v944 */
    public ?int $dataInstanceId = null;
}