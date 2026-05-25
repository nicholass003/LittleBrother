<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\BookEditType;

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