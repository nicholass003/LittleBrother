<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;

class UpdateAdventureSettingsPacket implements Packet{

    public const ID = PacketIds::UPDATE_ADVENTURE_SETTINGS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $noPvM;
    public bool $noPvP;
    public bool $immutableWorld;
    public bool $showNameTags;
    public bool $autoJump;
}