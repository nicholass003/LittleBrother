<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\BookEditType;

class BookEditPacket implements Packet{

    public const ID = PacketIds::BOOK_EDIT;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BookEditType $type;
    public int $inventorySlot;
    public int $pageNumber;
    public int $secondaryPageNumber;
    public string $text;
    public string $photoName;
    public string $title;
    public string $author;
    public string $xuid;
}