<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\AnimateAction;

class AnimatePacket implements Packet{

    public const ID = PacketIds::ANIMATE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public AnimateAction $action;
    public int $actorRuntimeId;
    /** @since v859 */
    public float $data = 0.0;
    /** @deprecated v898 */
    public ?float $rowingTime = null;
    /** @since v898 */
    public ?string $swingSource = null;
}