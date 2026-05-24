<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\TextureShiftAction;

/** @since v924 */
class ClientboundTextureShiftPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_TEXTURE_SHIFT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public TextureShiftAction $action;
    public string $collectionName;
    public string $fromStep;
    public string $toStep;
    /** @var list<string> */
    public array $allSteps;
	public int $currentLengthTicks;
	public int $totalLengthTicks;
	public bool $enabled;
}