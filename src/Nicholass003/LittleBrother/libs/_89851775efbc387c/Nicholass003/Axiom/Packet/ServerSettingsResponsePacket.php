<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

class ServerSettingsResponsePacket implements Packet{

    public const ID = PacketIds::SERVER_SETTINGS_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $formId;
    public string $formData; // JSON string
}