<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ResourcePack\ResourcePackInfoEntry;

class ResourcePacksInfoPacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACKS_INFO;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var ResourcePackInfoEntry[] */
    public array $resourcePackEntries = [];

    public bool $mustAccept;
    public bool $hasAddons;
    public bool $hasScripts;
    public bool $forceDisableVibrantVisuals;

    public string $worldTemplateId;
    public string $worldTemplateVersion;
}