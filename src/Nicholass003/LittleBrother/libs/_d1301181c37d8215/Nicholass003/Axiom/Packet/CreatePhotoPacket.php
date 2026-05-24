<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

final class CreatePhotoPacket implements Packet{

    public const ID = PacketIds::CREATE_PHOTO;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorUniqueId;
    public string $photoName;
    public string $photoItemName;
}