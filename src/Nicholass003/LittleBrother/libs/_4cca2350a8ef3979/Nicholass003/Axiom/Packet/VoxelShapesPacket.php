<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\SerializableVoxelShape;

/** @since v924 */
class VoxelShapesPacket implements Packet{

    public const ID = PacketIds::VOXEL_SHAPES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<SerializableVoxelShape> */
    public array $shapes = [];
    /** @var list<string, int> */
    public array $nameMap = [];
    /** @since v944 */
    public int $customShapeCount = 0;
}