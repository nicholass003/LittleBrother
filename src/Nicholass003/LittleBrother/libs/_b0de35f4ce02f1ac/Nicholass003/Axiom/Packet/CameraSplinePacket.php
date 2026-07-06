<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera\CameraSplineDefinition;

/** @since v924 */
class CameraSplinePacket implements Packet{

    public const ID = PacketIds::CAMERA_SPLINE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var CameraSplineDefinition[] */
    public array $splines = [];
}