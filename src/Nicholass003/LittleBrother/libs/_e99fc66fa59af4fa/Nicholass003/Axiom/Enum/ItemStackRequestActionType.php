<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum ItemStackRequestActionType : int{

    case UNKNOWN = -1;
    case TAKE = 0;
    case PLACE = 1;
    case SWAP = 2;
    case DROP = 3;
    case DESTROY = 4;
    case CRAFTING_CONSUME_INPUT = 5;
    case CRAFTING_CREATE_SPECIFIC_RESULT = 6;
    case LAB_TABLE_COMBINE = 9;
    case BEACON_PAYMENT = 10;
    case MINE_BLOCK = 11;
    case CRAFTING_RECIPE = 12;
    case CRAFTING_RECIPE_AUTO = 13;
    case CREATIVE_CREATE = 14;
    case CRAFTING_RECIPE_OPTIONAL = 15;
    case CRAFTING_GRINDSTONE = 16;
    case CRAFTING_LOOM = 17;
    case CRAFTING_NON_IMPLEMENTED_DEPRECATED_ASK_TY_LAING = 18;
    case CRAFTING_RESULTS_DEPRECATED_ASK_TY_LAING = 19;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}