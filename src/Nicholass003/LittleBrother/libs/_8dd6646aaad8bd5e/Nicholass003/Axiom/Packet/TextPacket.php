<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\TextType;

class TextPacket implements Packet{

    public const ID = PacketIds::TEXT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public TextType $type;
    public bool $needsTranslation = false;
    public string $sourceName = "";
    public string $message = "";
    /** @var string[] */
    public array $parameters = [];
    public string $xboxUserId = "";
    public string $platformChatId = "";
    public ?string $filteredMessage = null;
}