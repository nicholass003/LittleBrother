<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Camera\CameraSplineDefinition;

/** @since v924 */
class CameraSplinePacket implements Packet{

    public const ID = PacketIds::CAMERA_SPLINE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var CameraSplineDefinition[] */
    public array $splines = [];
}