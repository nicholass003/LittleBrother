<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Graphics;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

/** @since v859 */
class ParameterKeyframeValue{

    public function __construct(
        public readonly float $time,
        public readonly Vec3 $value
    ){}
}