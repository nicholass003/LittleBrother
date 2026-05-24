<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Skin\SkinData;

class PlayerSkinPacket implements Packet{

    public const ID = PacketIds::PLAYER_SKIN;
    public const RECIPIENT = PacketRecipient::BOTH;

    public string $uuid;
    public SkinData $skin;
    public string $newSkinName = "";
    public string $oldSkinName = "";
    public bool $isVerified = true;
}