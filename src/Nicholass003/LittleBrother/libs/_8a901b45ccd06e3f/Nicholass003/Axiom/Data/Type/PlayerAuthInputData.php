<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Common\BitSet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequest;

class PlayerAuthInputData{

    /**
     * @param list<PlayerBlockActionStopBreak|PlayerBlockActionWithBlockInfo>|null $blockActions
     */
    public function __construct(
        public readonly Vec3 $position,
        public readonly float $pitch,
        public readonly float $yaw,
        public readonly float $headYaw,
        public readonly float $moveVecX,
        public readonly float $moveVecZ,
        public readonly BitSet $inputFlags,
        public readonly int $inputMode,
        public readonly int $playMode,
        public readonly int $interactionMode,
        public readonly Vec2 $interactRotation,
        public readonly int $tick,
        public readonly Vec3 $delta,
        public readonly ?ItemInteractionData $itemInteractionData,
        public readonly ?ItemStackRequest $itemStackRequest,
        public readonly ?array $blockActions,
        public readonly ?PlayerAuthInputVehicleInfo $vehicleInfo,
        public readonly float $analogMoveVecX,
        public readonly float $analogMoveVecZ,
        public readonly Vec3 $cameraOrientation,
        public readonly Vec2 $rawMove
    ){}
}