<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;

class PhotoTransferPacket implements Packet{

    public const ID = PacketIds::PHOTO_TRANSFER;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $photoName;
    public string $photoData;
    public string $bookId;
    public int $type;
    public int $sourceType;
    public int $ownerActorUniqueId; // Signed long
    public string $newPhotoName;
}