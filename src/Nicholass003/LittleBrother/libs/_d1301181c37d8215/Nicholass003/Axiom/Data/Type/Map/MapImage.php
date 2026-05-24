<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Map;

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