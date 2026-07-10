<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera\CameraSplineDefinition;

/** @since v924 */
class CameraSplinePacket implements Packet{

    public const ID = PacketIds::CAMERA_SPLINE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var CameraSplineDefinition[] */
    public array $splines = [];
}