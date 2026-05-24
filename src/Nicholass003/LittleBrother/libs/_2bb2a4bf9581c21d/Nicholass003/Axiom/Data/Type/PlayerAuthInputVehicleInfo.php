<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

class PlayerAuthInputVehicleInfo{

    public function __construct(
        public readonly float $vehicleRotationX,
        public readonly float $vehicleRotationZ,
        public readonly int $predictedVehicleActorUniqueId
    ){}
}