<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

class ServerSettingsResponsePacket implements Packet{

    public const ID = PacketIds::SERVER_SETTINGS_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $formId;
    public string $formData; // JSON string
}