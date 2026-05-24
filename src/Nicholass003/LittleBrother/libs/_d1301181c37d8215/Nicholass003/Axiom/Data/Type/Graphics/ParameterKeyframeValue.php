<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Graphics;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Vec3;

/** @since v859 */
class ParameterKeyframeValue{

    public function __construct(
        public readonly float $time,
        public readonly Vec3 $value
    ){}
}