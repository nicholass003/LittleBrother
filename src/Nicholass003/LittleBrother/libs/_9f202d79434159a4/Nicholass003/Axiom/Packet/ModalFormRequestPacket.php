<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;

class ModalFormRequestPacket implements Packet{

    public const ID = PacketIds::MODAL_FORM_REQUEST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $formId;
    public string $formData;
}