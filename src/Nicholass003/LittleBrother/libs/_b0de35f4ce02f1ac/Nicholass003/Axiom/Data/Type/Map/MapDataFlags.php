<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Map;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\MapDataFlag;

final class MapDataFlags{

    private function __construct(
        private readonly int $flags
    ){}

    public static function fromInt(int $flags) : self{
        return new self($flags);
    }

    public function toInt() : int{
        return $this->flags;
    }

    public function hasTextureUpdate() : bool{
        return $this->has(MapDataFlag::TEXTURE_UPDATE);
    }

    public function hasDecorationUpdate() : bool{
        return $this->has(MapDataFlag::DECORATION_UPDATE);
    }

    public function hasMapCreation() : bool{
        return $this->has(MapDataFlag::MAP_CREATION);
    }

    public function requiresScale() : bool{
        return $this->hasMapCreation() || $this->hasDecorationUpdate() || $this->hasTextureUpdate();
    }

    private function has(MapDataFlag $flag) : bool{
        return ($this->flags & $flag->value) !== 0;
    }
}