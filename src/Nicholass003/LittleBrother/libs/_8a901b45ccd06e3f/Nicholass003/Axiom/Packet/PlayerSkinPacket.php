<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Skin\SkinData;

class PlayerSkinPacket implements Packet{

    public const ID = PacketIds::PLAYER_SKIN;
    public const RECIPIENT = PacketRecipient::BOTH;

    public string $uuid;
    public SkinData $skin;
    public string $newSkinName = "";
    public string $oldSkinName = "";
    public bool $isVerified = true;
}