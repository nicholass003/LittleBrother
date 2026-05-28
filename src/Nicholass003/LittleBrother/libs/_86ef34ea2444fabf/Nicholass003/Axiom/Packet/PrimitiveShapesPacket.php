<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Debug\PacketShapeData;

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