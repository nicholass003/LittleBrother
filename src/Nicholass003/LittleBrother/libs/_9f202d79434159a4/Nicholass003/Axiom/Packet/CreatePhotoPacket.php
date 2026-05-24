<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;

final class CreatePhotoPacket implements Packet{

    public const ID = PacketIds::CREATE_PHOTO;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorUniqueId;
    public string $photoName;
    public string $photoItemName;
}