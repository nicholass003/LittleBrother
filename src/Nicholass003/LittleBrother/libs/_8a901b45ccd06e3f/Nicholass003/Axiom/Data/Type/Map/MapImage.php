<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Map;

class MapImage{

    /** @var list<list<int>> RGBA colors */
    public readonly array $pixels;

    public function __construct(
        public readonly int $width,
        public readonly int $height,
        array $pixels
    ){
        $this->pixels = $pixels;
    }
}