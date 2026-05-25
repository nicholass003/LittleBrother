<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844\CraftingDataCodec as V844CraftingDataCodec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe\MultiRecipe;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe\RecipeWithTypeId;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe\ShapedRecipe;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe\ShapelessRecipe;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe\SmithingTransformRecipe;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe\SmithingTrimRecipe;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\CraftingDataPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CraftingDataCodec extends V844CraftingDataCodec{

    protected function readRecipeWithTypeId(ByteBufferReader $in, int $recipeType, CodecType $codec) : RecipeWithTypeId{
        return match($recipeType){
            CraftingDataPacket::ENTRY_SHAPELESS,
            CraftingDataPacket::ENTRY_USER_DATA_SHAPELESS,
            CraftingDataPacket::ENTRY_SHAPELESS_CHEMISTRY => $this->readShapelessRecipe($in, $recipeType, $codec),
            CraftingDataPacket::ENTRY_SHAPED,
            CraftingDataPacket::ENTRY_SHAPED_CHEMISTRY => $this->readShapedRecipe($in, $recipeType, $codec),
            CraftingDataPacket::ENTRY_MULTI => $this->readMultiRecipe($in, $recipeType),
            CraftingDataPacket::ENTRY_SMITHING_TRANSFORM => $this->readSmithingTransformRecipe($in, $recipeType, $codec),
            CraftingDataPacket::ENTRY_SMITHING_TRIM => $this->readSmithingTrimRecipe($in, $recipeType, $codec),
            default => throw new \RuntimeException("Unknown recipe type $recipeType")
        };
    }

    protected function writeRecipeWithTypeId(ByteBufferWriter $out, RecipeWithTypeId $recipe, CodecType $codec) : void{
        if($recipe instanceof ShapelessRecipe){
            $this->writeShapelessRecipe($out, $recipe, $codec);
        }elseif($recipe instanceof ShapedRecipe){
            $this->writeShapedRecipe($out, $recipe, $codec);
        }elseif($recipe instanceof MultiRecipe){
            $this->writeMultiRecipe($out, $recipe);
        }elseif($recipe instanceof SmithingTransformRecipe){
            $this->writeSmithingTransformRecipe($out, $recipe, $codec);
        }elseif($recipe instanceof SmithingTrimRecipe){
            $this->writeSmithingTrimRecipe($out, $recipe, $codec);
        }else{
            throw new \RuntimeException("Unknown recipe type " . $recipe::class);
        }
    }
}