<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;

class ModalFormResponsePacket implements Packet{

    public const ID = PacketIds::MODAL_FORM_RESPONSE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $formId;
    public ?string $formData = null;
    public ?int $cancelReason = null;
}