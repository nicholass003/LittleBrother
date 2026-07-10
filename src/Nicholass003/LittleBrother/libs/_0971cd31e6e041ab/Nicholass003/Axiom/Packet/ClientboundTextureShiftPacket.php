<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\TextureShiftAction;

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