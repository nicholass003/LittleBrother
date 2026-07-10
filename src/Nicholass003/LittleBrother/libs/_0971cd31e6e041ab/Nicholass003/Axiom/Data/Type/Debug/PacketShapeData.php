<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Debug;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ScriptDebugShapeType;

class PacketShapeData{

    public function __construct(
        public readonly int $networkId,
        public readonly ?ScriptDebugShapeType $type,
        public readonly ?Vec3 $location,
        public readonly ?float $scale,
        public readonly ?Vec3 $rotation,
        public readonly ?float $totalTimeLeft,
        public readonly ?int $colorArgb,
        public readonly ?string $text,
        public readonly ?Vec3 $boxBound,
        public readonly ?Vec3 $lineEndLocation,
        public readonly ?float $arrowHeadLength,
        public readonly ?float $arrowHeadRadius,
        public readonly ?int $segments,
    ){}
}