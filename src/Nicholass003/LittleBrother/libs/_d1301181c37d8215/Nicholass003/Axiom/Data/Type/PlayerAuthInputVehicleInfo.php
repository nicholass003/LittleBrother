<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type;

class PlayerAuthInputVehicleInfo{

    public function __construct(
        public readonly float $vehicleRotationX,
        public readonly float $vehicleRotationZ,
        public readonly int $predictedVehicleActorUniqueId
    ){}
}