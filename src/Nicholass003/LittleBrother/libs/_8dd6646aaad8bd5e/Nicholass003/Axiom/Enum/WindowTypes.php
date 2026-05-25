<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum WindowTypes : int{

    case NONE = -9;
    case INVENTORY = -1;
    case CONTAINER = 0;
    case WORKBENCH = 1;
    case FURNACE = 2;
    case ENCHANTMENT = 3;
    case BREWING_STAND = 4;
    case ANVIL = 5;
    case DISPENSER = 6;
    case DROPPER = 7;
    case HOPPER = 8;
    case CAULDRON = 9;
    case MINECART_CHEST = 10;
    case MINECART_HOPPER = 11;
    case HORSE = 12;
    case BEACON = 13;
    case STRUCTURE_EDITOR = 14;
    case TRADING = 15;
    case COMMAND_BLOCK = 16;
    case JUKEBOX = 17;
    case ARMOR = 18;
    case HAND = 19;
    case COMPOUND_CREATOR = 20;
    case ELEMENT_CONSTRUCTOR = 21;
    case MATERIAL_REDUCER = 22;
    case LAB_TABLE = 23;
    case LOOM = 24;
    case LECTERN = 25;
    case GRINDSTONE = 26;
    case BLAST_FURNACE = 27;
    case SMOKER = 28;
    case STONECUTTER = 29;
    case CARTOGRAPHY = 30;
    case HUD = 31;
    case JIGSAW_EDITOR = 32;
    case SMITHING_TABLE = 33;
    case CHEST_BOAT = 34;
    case DECORATED_POT = 35;
    case CRAFTER = 36;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}