<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Map;

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