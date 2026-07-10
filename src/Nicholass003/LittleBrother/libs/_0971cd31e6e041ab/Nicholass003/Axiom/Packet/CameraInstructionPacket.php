<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera\CameraFadeInstruction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera\CameraFovInstruction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera\CameraSetInstruction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera\CameraSplineInstruction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera\CameraTargetInstruction;

class CameraInstructionPacket implements Packet{

    public const ID = PacketIds::CAMERA_INSTRUCTION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ?CameraSetInstruction $set = null;
    public ?bool $clear = null;
    public ?CameraFadeInstruction $fade = null;
    public ?CameraTargetInstruction $target = null;
    public ?bool $removeTarget = null;
    public ?CameraFovInstruction $fieldOfView = null;
	public ?CameraSplineInstruction $spline = null;
	public ?int $attachToEntity = null;
	public ?bool $detachFromEntity = null;
}