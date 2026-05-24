<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Recipe\MaterialReducerRecipe;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Recipe\PotionContainerChangeRecipe;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Recipe\PotionTypeRecipe;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Recipe\RecipeWithTypeId;

final class CraftingDataPacket implements Packet{

    public const ID = PacketIds::CRAFTING_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public const ENTRY_SHAPELESS = 0;
    public const ENTRY_SHAPED = 1;
    public const ENTRY_FURNACE = 2;
    public const ENTRY_FURNACE_DATA = 3;
    public const ENTRY_MULTI = 4;
    public const ENTRY_USER_DATA_SHAPELESS = 5;
    public const ENTRY_SHAPELESS_CHEMISTRY = 6;
    public const ENTRY_SHAPED_CHEMISTRY = 7;
    public const ENTRY_SMITHING_TRANSFORM = 8;
    public const ENTRY_SMITHING_TRIM = 9;

    /** @var list<RecipeWithTypeId> */
    public array $recipesWithTypeIds = [];
    /** @var list<PotionTypeRecipe> */
    public array $potionTypeRecipes = [];
    /** @var list<PotionContainerChangeRecipe> */
    public array $potionContainerRecipes = [];
    /** @var list<MaterialReducerRecipe> */
    public array $materialReducerRecipes = [];
    public bool $cleanRecipes = false;
}