<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Structure;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\StructureBlockType;

class StructureEditorData{

    public function __construct(
        public string $structureName,
        public string $filteredStructureName,
        public string $structureDataField,
        public bool $includePlayers,
        public bool $showBoundingBox,
        public StructureBlockType $structureBlockType,
        public StructureSettings $structureSettings,
        public int $structureRedstoneSaveMode
    ){}
}