<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type;

class BlockPaletteEntry{

    public function __construct(
        public readonly string $name,
        public readonly string $nbt // raw encoded NBT
    ){}
}