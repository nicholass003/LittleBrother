<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\SoundEventType;

/** @since v1001 */
class ClientboundUpdateSoundDataPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_UPDATE_SOUND_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $serverSoundHandle = 0;
    public SoundEventType $soundEvent = SoundEventType::STOP;
}