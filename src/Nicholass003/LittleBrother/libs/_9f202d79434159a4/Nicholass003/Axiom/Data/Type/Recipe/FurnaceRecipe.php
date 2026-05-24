<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\ItemStack;

final class FurnaceRecipe extends RecipeWithTypeId{

    public function __construct(
        int $typeId,
        public readonly int $inputId,
        public readonly ?int $inputMeta,
        public readonly ItemStack $result,
        public readonly string $blockName
    ){
        parent::__construct($typeId);
    }
}