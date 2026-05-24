<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\MultiplayerSettingsAction;

class MultiplayerSettingsPacket implements Packet{

    public const ID = PacketIds::MULTIPLAYER_SETTINGS;
    public const RECIPIENT = PacketRecipient::BOTH;

    public MultiplayerSettingsAction $action;
}