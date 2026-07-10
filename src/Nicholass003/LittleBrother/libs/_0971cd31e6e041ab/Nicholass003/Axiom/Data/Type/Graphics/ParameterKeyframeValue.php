<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Graphics;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

/** @since v859 */
class ParameterKeyframeValue{

    public function __construct(
        public readonly float $time,
        public readonly Vec3 $value
    ){}
}