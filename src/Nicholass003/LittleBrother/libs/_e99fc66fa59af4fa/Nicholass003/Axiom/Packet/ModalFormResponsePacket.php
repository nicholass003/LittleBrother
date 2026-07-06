<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;

class ModalFormResponsePacket implements Packet{

    public const ID = PacketIds::MODAL_FORM_RESPONSE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $formId;
    public ?string $formData = null;
    public ?int $cancelReason = null;
}