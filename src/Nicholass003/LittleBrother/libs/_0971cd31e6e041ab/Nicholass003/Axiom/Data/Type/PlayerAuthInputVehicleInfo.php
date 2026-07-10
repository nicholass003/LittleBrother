<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class PlayerAuthInputVehicleInfo{

    public function __construct(
        public readonly float $vehicleRotationX,
        public readonly float $vehicleRotationZ,
        public readonly int $predictedVehicleActorUniqueId
    ){}
}