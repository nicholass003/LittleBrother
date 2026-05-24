<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Debug\PacketShapeData;

/** 
 * Previously DebugDrawerPacket
 * 
 * @since v975
 */
class PrimitiveShapesPacket implements Packet{

    public const ID = PacketIds::PRIMITIVE_SHAPES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<PacketShapeData> */
    public array $shapes = [];
}