<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\GraphicsMode;

class UpdateClientOptionsPacket implements Packet{

    public const ID = PacketIds::UPDATE_CLIENT_OPTIONS;
    public const RECIPIENT = PacketRecipient::SERVER;

    public ?GraphicsMode $graphicsMode = null;
    /** @since v975 */
    public ?bool $filterProfanityChange = null;
}