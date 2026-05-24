<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Map\MapDataFlags;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Map\MapDecoration;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Map\MapImage;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Map\MapTrackedObject;

class ClientboundMapItemDataPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_MAP_ITEM_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $mapId;
    public MapDataFlags $type;
    public int $dimensionId;
    public bool $isLocked;
    public BlockPosition $origin;
    /** @var list<int> */
    public array $parentMapIds = [];
    public ?int $scale = null;
    /** @var list<MapTrackedObject> */
    public array $trackedEntities = [];
    /** @var list<MapDecoration> */
    public array $decorations = [];
    public int $xOffset = 0;
    public int $yOffset = 0;
    public ?MapImage $colors = null;
}